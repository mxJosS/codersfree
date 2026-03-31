<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Course;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class PromotionalVideo extends Component
{
    use WithFileUploads;

    public $course;

    #[Validate('required|file|mimes:mp4,mov,avi,mkv,wmv|max:512000')]
    public $video;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function save()
    {
        $this->validate();

        $this->course->video_path = $this->video->store('courses/promotional-videos', 'public');
        $this->course->save();

        $this->dispatch('saved');

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Video publicado!',
            'text' => 'El video promocional se ha subido con éxito.'
        ]);

        $this->reset('video');
    }

    public function render()
    {
        return view('livewire.instructor.courses.promotional-video');
    }

    public function destroy()
    {
        if ($this->course->video_path) {
            Storage::disk('public')->delete($this->course->video_path);
            $this->course->video_path = null;
            $this->course->save();
            $this->course->refresh();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => '¡Eliminado!',
                'text' => 'El video ha sido borrado correctamente.'
            ]);
        }
    }
}
