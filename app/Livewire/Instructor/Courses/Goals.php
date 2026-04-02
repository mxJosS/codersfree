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
        $this->getGoals();
    }

    public function getGoals()
    {
        $this->goals = $this->course->goals()
            ->orderBy('order', 'asc')
            ->get()
            ->keyBy('id')
            ->toArray();
    }

    public function store()
    {
        $this->validateOnly('name');

        $lastOrder = $this->course->goals()->max('order') ?? 0;

        $this->course->goals()->create([
            'name' => $this->name,
            'order' => $lastOrder + 1
        ]);

        $this->reset('name');
        $this->getGoals();

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

        foreach ($this->goals as $id => $goalData) {
            Goal::where('id', $id)->update([
                'name' => $goalData['name']
            ]);
        }

        $this->getGoals();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Actualizado!',
            'text' => 'Las metas se han actualizado correctamente.'
        ]);
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        $this->getGoals();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Eliminado!',
            'text' => 'La meta ha sido eliminada correctamente.'
        ]);
    }

    public function reorder($goalsData)
    {
        foreach ($goalsData as $data) {
            Goal::where('id', $data['id'])->update([
                'name' => $data['name'],
                'order' => $data['order']
            ]);
        }

        $this->getGoals();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Sincronizado!',
            'text' => 'El orden y los cambios se han guardado.'
        ]);
    }

    public function render()
    {
        return view('livewire.instructor.courses.goals');
    }
}
