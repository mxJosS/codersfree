<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Models\Lesson;
use App\Rules\UniqueLessonCourse;
class ManageLessons extends Component
{
    use WithFileUploads;

    public $section;
    public $lessons;
    public $video, $url;

    public $lessonCreate = [
        'open' => false,
        'name' => null,
        'slug' => null,
        'platform' => 1,
        'video_original_name' => null,
    ];

    public function rules()
    {
        $rules = [
            'lessonCreate.name' => ['required', 'max:255', new UniqueLessonCourse($this->section->course_id)],
            'lessonCreate.slug' => ['required', new UniqueLessonCourse($this->section)],
        ];

        if ($this->lessonCreate['platform'] == 1) {
            $rules['video'] = 'required|mimes:mp4,mov,ogg,qt|max:512000';
        } else {
            $rules['url'] = ['required', 'regex:/^(?:https?:\/\/)?(?:www\.)?(youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([\w-]{10,12})/'];
        }

        return $rules;
    }

    public function store()
    {
        $this->lessonCreate['slug'] = Str::slug($this->lessonCreate['name']);

        $this->validate();

        if ($this->lessonCreate['platform'] == 1) {
            $this->lessonCreate['video_original_name'] = $this->video->getClientOriginalName();
            $lesson = $this->section->lessons()->create($this->lessonCreate);

            $this->dispatch('uploadVideo', $lesson->id)->self();
        } elseif ($this->lessonCreate['platform'] == 2) {
            $this->lessonCreate['video_original_name'] = $this->url;
            $lesson = $this->section->lessons()->create($this->lessonCreate);
        }

        $this->lessons = $this->section->lessons;

        $this->reset(['url', 'lessonCreate']);

        $this->dispatch('swal', title: '¡Lección creada!', text: 'La lección se ha guardado correctamente.', icon: 'success');
    }

    #[On('uploadVideo')]
    public function uploadVideo($lessonId)
    {
        $lesson = Lesson::find($lessonId);
        $lesson->video_path = $this->video->store('courses/lessons', 'public');
        $lesson->save();

        $this->reset('video');

        $this->lessons = $this->section->lessons;
    }

    public function render()
    {
        return view('livewire.instructor.courses.manage-lessons');
    }
}
