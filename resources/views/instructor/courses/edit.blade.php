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
                <nav class="mb-6">
                    <ul>
                        <li class="border-l-4 border-indigo-400 pl-3">
                            <a href="{{ route('instructor.courses.edit', $course) }}" class="font-medium text-indigo-600">
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

                        <x-validation-errors class="mb-4" />

                        {{-- Título --}}
                        <div class="mb-4">
                            <x-label value="Título del curso" class="mb-2" />
                            <x-input type="text" id="title" class="w-full" value="{{ old('title', $course->title) }}" name="title" onkeyup="string_to_slug(this.value, '#slug')" />
                        </div>

                        {{-- Slug (Solo si no está publicado) --}}
                        @empty($course->published_at)
                            <div class="mb-4">
                                <x-label value="Slug del curso" class="mb-2" />
                                <x-input type="text" id="slug" class="w-full bg-gray-50" value="{{ old('slug', $course->slug) }}" name="slug" readonly />
                            </div>
                        @endempty

                        {{-- Resumen --}}
                        <div class="mb-4">
                            <x-label value="Resumen del curso" class="mb-2" />
                            <x-textarea class="w-full resize-none" name="summary" rows="3">{{ old('summary', $course->summary) }}</x-textarea>
                        </div>

                        {{-- Descripción (CKEditor) --}}
                        <div class="mb-4 ckeditor">
                            <x-label value="Descripción del curso" class="mb-2" />
                            <x-textarea id="editor-description" class="w-full" name="description">{{ old('description', $course->description) }}</x-textarea>
                        </div>

                        {{-- Selects --}}
                        <div class="grid md:grid-cols-3 gap-4 mb-8">
                            <div>
                                <x-label class="mb-1">Categorías</x-label>
                                <x-select name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @selected(old('category_id', $course->category_id) == $category->id)>{{$category->name}}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div>
                                <x-label class="mb-1">Niveles</x-label>
                                <x-select name="level_id">
                                    @foreach ($levels as $level)
                                        <option value="{{$level->id}}" @selected(old('level_id', $course->level_id) == $level->id)>{{$level->name}}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div>
                                <x-label class="mb-1">Precio</x-label>
                                <x-select name="price_id">
                                    @foreach ($prices as $price)
                                        <option value="{{$price->id}}" @selected(old('price_id', $course->price_id) == $price->id)>
                                            {{ $price->value == 0 ? 'Gratis' : $price->value . ' US$' }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>

                        {{-- Imagen --}}
                        <div>
                            <p class="text-2xl font-semibold mb-4">Imagen del curso</p>
                            <div class="grid md:grid-cols-2 gap-4">
                                <figure>
                                    <img id="picture" class="w-full aspect-video object-contain border rounded-md" src="{{ $course->image }}" alt="Vista previa">
                                </figure>
                                <div>
                                    <p class="mb-4 text-sm text-gray-600 italic">Sube una imagen atractiva. Formatos aceptados: JPG, PNG.</p>
                                    <div class="flex items-center justify-center w-full">
                                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <i class="fa-solid fa-cloud-arrow-up text-2xl text-gray-400 mb-2"></i>
                                                <p class="text-sm text-gray-500 font-semibold">Haz clic para cambiar imagen</p>
                                            </div>
                                            <input id="file" type="file" name="image" class="hidden" accept="image/*" onchange="preview_image(event, '#picture')" />
                                        </label>
                                    </div>
                                    <div class="flex gap-4 justify-end mt-6">
                                        <x-button type="submit">Actualizar información</x-button>
                                        {{-- Botón de eliminar (dispara el JS de confirmación) --}}
                                        <button type="button" onclick="confirmDelete()" class="btn btn-red text-sm flex items-center">
                                            <i class="fa-solid fa-trash-can mr-2"></i> Eliminar curso
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Formulario oculto para eliminación (FUERA del form de update) --}}
                    <form action="{{ route('instructor.courses.destroy', $course) }}" method="POST" id="delete-form" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </x-container>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    @vite(['resources/js/helpers/string_to_slug.js', 'resources/js/helpers/preview_image.js'])

    <script>
        // Inicializar CKEditor
        ClassicEditor
            .create(document.querySelector('#editor-description'))
            .catch(error => { console.error(error); });

        // Confirmación de eliminación
        function confirmDelete() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer y eliminará todo el curso.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar permanentemente',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            })
        }
    </script>

    @if (session('info'))
        <script>
            Swal.fire({
                title: '¡Operación exitosa!',
                text: "{{ session('info') }}",
                icon: 'success',
                confirmButtonColor: '#4F46E5',
            });
        </script>
    @endif
</x-instructor-layout>
