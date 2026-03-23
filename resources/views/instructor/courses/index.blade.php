<x-instructor-layout>
     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Cursos
        </h2>
    </x-slot>
    <x-container class="mt-12">
        <div class="md:flex md:justify-end">
            <a href="{{route('instructor.courses.create')}}" class="btn block btn-red w-full text-center md:w-auto">
                Crear Curso
            </a>
        </div>
    </x-container>
    
</x-instructor-layout>