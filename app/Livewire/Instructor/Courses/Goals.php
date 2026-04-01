<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Goal;
use App\Models\Course;

class Goals extends Component
{
    public Course $course;
    public $goals = [];

    #[Validate('required|string|max:255')]
    public $name;

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->goals = $course->goals->toArray();
    }

    public function store()
    {
        $this->validateOnly('name');

        $this->course->goals()->create([
            'name' => $this->name
        ]);

        $this->reset('name');
        $this->goals = $this->course->goals()->get()->toArray();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Meta agregada!',
            'text' => 'La meta del curso se ha guardado correctamente.'
        ]);
    }

    public function update()
    {
        $this->validate([
            'goals.*.name' => 'required|string|max:255'
        ]);

        foreach ($this->goals as $goalData) {
            Goal::where('id', $goalData['id'])->update([
                'name' => $goalData['name']
            ]);
        }

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Actualizado!',
            'text' => 'Las metas se han actualizado correctamente.'
        ]);
    }

    public function render()
    {
        return view('livewire.instructor.courses.goals');
    }
}
