<x-instructor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Cursos
        </h2>
    </x-slot>

    <x-container class="mt-12">
        <div class="md:flex md:justify-end mb-6">
            <a href="{{route('instructor.courses.create')}}" class="btn block btn-red w-full text-center md:w-auto">
                Crear Curso
            </a>
        </div>

        <ul>
            @forelse ($courses as $course)
                <li class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row mb-6">
                    <figure class="flex-shrink-0">
                        <img src="{{ $course->image }}" class="w-full h-48 md:h-full md:w-48 object-cover object-center">
                    </figure>

                    <a href="{{ route('instructor.courses.edit', $course) }}" class="flex-1 flex flex-col justify-center py-4 px-6 md:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-9 gap-4 items-center">

                            <div class="col-span-1 md:col-span-3">
                                <h1 class="text-lg font-bold text-gray-800">{{ $course->title }}</h1>
                                @switch($course->status->name)
                                    @case('BORRADOR')
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded border border-red-400">
                                            {{ $course->status->name }}
                                        </span>
                                        @break

                                    @case('PENDIENTE')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded border border-yellow-300">
                                            {{ $course->status->name }}
                                        </span>
                                        @break

                                    @case('APROBADO')
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-400">
                                            {{ $course->status->name }}
                                        </span>
                                        @break
                                @endswitch
                            </div>

                            <div class="col-span-1 md:col-span-2 flex md:flex-col justify-between md:justify-start">
                                <div>
                                    <p class="text-sm font-bold">100 USD</p>
                                    <p class="text-xs text-gray-500">Ganado este mes</p>
                                </div>
                                <div class="md:mt-2 text-right md:text-left">
                                    <p class="text-sm font-bold">1000 USD</p>
                                    <p class="text-xs text-gray-500">Ganado en total</p>
                                </div>
                            </div>

                            <div class="col-span-1 md:col-span-2 flex md:flex-col justify-between md:justify-center md:text-center border-t md:border-t-0 pt-2 md:pt-0">
                                <p class="text-xs text-gray-500 md:hidden">Inscripciones:</p>
                                <div>
                                    <p class="text-sm font-bold">50</p>
                                    <p class="text-xs text-gray-500 hidden md:block">Inscripciones</p>
                                </div>
                            </div>

                            <div class="col-span-1 md:col-span-2 flex flex-col items-end md:items-center border-t md:border-t-0 pt-2 md:pt-0">
                                <div class="flex items-center">
                                    <p class="font-bold text-gray-700 mr-2">5</p>
                                    <ul class="flex text-xs text-yellow-400">
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                        <li><i class="fa-solid fa-star"></i></li>
                                    </ul>
                                </div>
                                <p class="text-xs text-gray-500">Valoración</p>
                            </div>

                        </div>


                    </a>
                </li>
                @empty
                <li class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex justify-between item-center">
                        <p>Salta a la Creación de un curso</p>
                        <a href="{{ route('instructor.courses.create') }}" class="btn btn-blue"> Crea tu curso</a>
                    </div>

                </li>
            @endforelse
        </ul>
    </x-container>
</x-instructor-layout>
