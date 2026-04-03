<div>
    <p class="text-2xl font-semibold">Secciones del Curso</p>
    <hr class="mt-2 mb-6">
    <ul class="mb-6 space-y-6">
        @forelse ($sections as $section)
            <li>
                <div class="bg-gray-100 rounded-lg shadow-lg px-6 py-4">
                    <div class="md:flex md:items-center">
                        <h1 class="md:flex-1 truncate">
                            Sección {{ $section->order }}:
                            <br class="md:hidden">
                            <span class="font-semibold">
                                {{ $section->name }}
                            </span>
                        </h1>
                        <div class="space-x-3 md:shrink-0 md:ml-4">
                            <button>
                                <i class="fas fa-edit hover:text-indigo-600"></i>
                            </button>
                            <button>
                                <i class="fas fa-trash-alt text-red-500 hover:text-red-700"></i>
                            </button>
                        </div>


                    </div>

                </div>
            </li>
        @empty
            <li>
                <div class="bg-gray-50 rounded-lg px-6 py-4 text-center text-gray-500">
                    No hay secciones creadas aún. Crea la primera sección abajo.
                </div>
            </li>
        @endforelse
    </ul>




    {{-- Crear Nueva Seccion --}}
    <form wire:submit.prevent="store">
        <x-input wire:model="name" class="w-full" placeholder="Ingrese el nombre de la sección" />
        <x-input-error for="name" />

        <div class="flex justify-end mt-2">
            <x-button>
                Agregar Sección
            </x-button>
        </div>
    </form>

