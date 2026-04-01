<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Goal;
use App\Models\Course;

class Goals extends Component
{
    public Course $course;

    #[Validate('required|string|max:255')]
    public $name;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function store()
    {
        $this->validate();

        $this->course->goals()->create([
            'name' => $this->name
        ]);

        $this->reset('name');

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Meta agregada!',
            'text' => 'La meta del curso se ha guardado correctamente.'
        ]);
    }

    public function render()
    {
        $goals = $this->course->goals()->get();

        return view('livewire.instructor.courses.goals', compact('goals'));
    }
}
