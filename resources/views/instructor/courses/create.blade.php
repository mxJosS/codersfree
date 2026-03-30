<x-instructor-layout>
     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear nuevo curso
        </h2>
    </x-slot>
    <x-container class="mt-12" width="4xl">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-4">
            <form action="{{route('instructor.courses.store')}}" method="POST">
                @csrf
                <h2 class="text-2xl uppercase text-center mb-8">Completa esta información para crear un nuevo curso</h2>
                <x-validation-errors class="mb-4">

                </x-validation-errors>
                <div class="mb-4">
                    <x-label class="mb-1">
                        Nombre del Curso
                    </x-label>
                    <x-input placeholder="Nombre del curso" class="w-full" name="title" value="{{old('title')}}"  oninput="string_to_slug(this.value, '#slug')" />
                </div>

                <div class="mb-4">
                    <x-label class="mb-1">
                        Slug del curso
                    </x-label>
                    <x-input id="slug"  placeholder="Ej: laravel-desde-cero" class="w-full" name="slug" value="{{old('slug')}}"  />
                </div>
                <div class="grid md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <x-label class="mb-1">
                            Categorías
                        </x-label>
                        <x-select name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    @selected(old('category_id') == $category->id)>
                                    {{$category->name}}
                                </option>

                            @endforeach
                        </x-select>

                    </div>

                    <div>
                        <x-label class="mb-1">
                            Niveles
                        </x-label>
                        <x-select name="level_id">
                            @foreach ($levels as $level)
                                <option value="{{$level->id}}"
                                    @selected(old('level_id') == $level->id)>
                                    {{$level->name}}
                                </option>

                            @endforeach
                        </x-select>

                    </div>


                    <div>
                        <x-label class="mb-1">
                            Precio
                        </x-label>
                        <x-select name="price_id">
                            @foreach ($prices as $price)
                                <option value="{{$price->id}}"
                                    @selected(old('price_id') == $price->id)>
                                    @if ($price->value == 0)
                                        Gratis
                                    @else
                                        {{$price->value}} US$ (nivel {{$loop->index}})
                                    @endif

                                </option>

                            @endforeach
                        </x-select>

                    </div>


                </div>

                <div class="flex justify-end">
                    <x-button>
                        Crear Curso
                    </x-button>
                </div>
            </form>
        </div>
    </x-container>
</x-instructor-layout>
