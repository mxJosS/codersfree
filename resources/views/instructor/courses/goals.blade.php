<x-instructor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Curso: {{ $course->title }}
        </h2>
    </x-slot>

    <x-container class="py-8">
        <x-instructor.course-sidebar :course="$course">
            @livewire('instructor.courses.goals', ['course' => $course] )
        </x-instructor.course-sidebar>
    </x-container>
</x-instructor-layout>
