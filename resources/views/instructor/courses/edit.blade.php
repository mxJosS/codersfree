<x-instructor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Curso: {{ $course->title }}
        </h2>
    </x-slot>
<x-container class="py-8">
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 py-8">
        <aside class="col-span-1">

            <h1 class="font-semibold text-xl mb-4">Edición del curso</h1>
            <nav class="">
                <ul>
                    <li class="border-l-4 border-indigo-400 pl-3">
                        <a href="{{ route('instructor.courses.edit', $course) }}">
                            Información del Curso
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="col-span-1 lg:col-span-4">
            <div class="card">

            </div>
        </div>
    </div>
</x-container>

</x-instructor-layout>
