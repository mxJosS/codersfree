<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;
use App\Models\Section;
use App\Models\Course;

class ManageSections extends Component
{
    public Course $course;
    public $name;
    public $sections = [];

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->loadSections();
    }

    public function loadSections()
    {
        $this->sections = Section::where('course_id', $this->course->id)
            ->orderBy('order', 'asc')
            ->get();
    }


    public function store()
    {
        $this->validate([
            'name'=>'required'
        ]);

        $this->course->sections()->create([
            'name'=>$this->name
        ]);

        $this->reset('name');
        $this->loadSections();
    }


    public function render()
    {
        return view('livewire.instructor.courses.manage-sections');
    }
}
