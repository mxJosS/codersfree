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
                    <form action="{{ route('instructor.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p class="text-2xl font-semibold">Información del Curso</p>

                        <hr class="mt-2 mb-6">

                        <x-validation-errors />
                        <div class="mb-4">
                            <x-label value="Título del curso" class="mb-2" />
                            <x-input type="text" class="w-full" value="{{ old('title',$course->title ) }}" name="title" />
                        </div>
                        @empty($course->published_at)
                            <div class="mb-4">
                                <x-label value="Slug del curso" class="mb-2" />
                                <x-input type="text" class="w-full" value="{{ old('slug',$course->slug ) }}" name="slug" />
                            </div>
                        @endempty
                        <div class="mb-4">
                            <x-label value="Descripción del curso" class="mb-2" />
                            <x-textarea class="w-full resize-none" name="summary">{{ old('summary', $course->summary) }}</x-textarea>
                        </div>

                        <div class="grid md:grid-cols-3 gap-4 mb-8">
                            <div>
                                <x-label class="mb-1">Categorías</x-label>
                                <x-select name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @selected(old('category_id', $course->category_id) == $category->id)>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div>
                                <x-label class="mb-1">Niveles</x-label>
                                <x-select name="level_id">
                                    @foreach ($levels as $level)
                                        <option value="{{$level->id}}" @selected(old('level_id', $course->level_id) == $level->id)>
                                            {{$level->name}}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div>
                                <x-label class="mb-1">Precio</x-label>
                                <x-select name="price_id">
                                    @foreach ($prices as $price)
                                        <option value="{{$price->id}}" @selected(old('price_id', $course->price_id) == $price->id)>
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

                        <div>
                            <p class="text-2xl font-semibold mb-4">Imagen del curso</p>
                            <div class="grid md:grid-cols-2 gap-4">
                                <figure>
                                    <img id="picture" class="w-full aspect-video object-contain object-center" src="{{ $course->image }}" alt="">
                                </figure>
                                <div>
                                    <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis delectus corporis accusamus eaque error, dolores veritatis quaerat dolore nisi obcaecati aperiam enim?</p>
                                    <div class="flex items-center justify-center w-full mt-4">
                                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haz clic para subir</span> o arrastra y suelta</p>
                                                <p class="text-xs text-gray-500">PNG, JPG (MAX. 800x400px)</p>
                                            </div>
                                            <input id="file" type="file" name="file" class="hidden" accept="image/*" />
                                        </label>
                                    </div>
                                    <div class="flex justify-end mt-6">
                                        <x-button type="submit">
                                            Actualizar información
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-container>

    <script>
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>
    <script src="{{ asset('vendor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#summary' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
</x-instructor-layout>
