@props(['course'])

@php
    $links = [
        [
            'name' => 'Información del Curso',
            'url' => route('instructor.courses.edit', $course),
            'active' => request()->routeIs('instructor.courses.edit')
        ],
        [
            'name' => 'Video promocional',
            'url' => route('instructor.courses.video', $course),
            'active' => request()->routeIs('instructor.courses.video')
        ],
        [
            'name' => 'Metas del curso',
            'url' => route('instructor.courses.goals', $course),
            'active' => request()->routeIs('instructor.courses.goals')
        ],
    ];
@endphp

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6 py-8">
    <aside class="col-span-1">
        <h1 class="font-semibold text-xl mb-4">Edición del curso</h1>
        <nav class="mb-6">
            <ul>
                @foreach ($links as $link)
                    <li class="border-l-4 {{ $link['active'] ? 'border-indigo-400' : 'border-transparent' }} pl-3 mb-4">
                        <a href="{{ $link['url'] }}"
                           class="font-medium {{ $link['active'] ? 'text-indigo-600' : 'text-gray-500 hover:text-indigo-600' }}">
                            {{ $link['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </aside>

    <div class="col-span-1 lg:col-span-4">
        <div class="card">
            {{ $slot }}
        </div>
    </div>
</div>
