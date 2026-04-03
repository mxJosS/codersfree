<div>
    <p class="text-2xl font-semibold">Requisitos del Curso</p>
    <hr class="mt-2 mb-6">

    @if (count($requirements))
        <ul class="space-y-3 mb-4" id="requirements-list">
            @foreach ($requirements as $requirementId => $requirement)
                <li wire:key="requirement-{{ $requirementId }}" data-id="{{ $requirementId }}">
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500 transition bg-white">

                        <x-input
                            wire:model.live="requirements.{{ $requirementId }}.name"
                            class="flex-1 border-none shadow-none focus:ring-0 rounded-none py-2 px-3 text-gray-700"
                        />

                        <div class="flex items-stretch bg-gray-50 border-l border-gray-300 divide-x divide-gray-300">
                            <button
                                onClick="destroyRequirement({{ $requirementId }})"
                                type="button"
                                class="text-red-400 hover:text-red-600 px-3 py-2 transition-colors duration-200"
                                title="Eliminar requisito"
                            >
                                <i class="fa-solid fa-trash-can"></i>
                            </button>

                            <div class="flex items-center px-3 text-gray-400 cursor-move hover:bg-gray-100 transition-colors" title="Reordenar">
                                <i class="fa-solid fa-bars text-sm"></i>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="flex justify-end mb-8">
            <x-button wire:click="update">
                Actualizar requisitos
            </x-button>
        </div>
    @endif

    <form wire:submit.prevent="store">
        <x-input wire:model="name" class="w-full" placeholder="Ingrese el nombre del requisito" />
        <x-input-error for="name" />

        <div class="flex justify-end mt-2">
            <x-button>
                Agregar requisito
            </x-button>
        </div>
    </form>

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.7/Sortable.min.js"></script>
    <script>
        function initRequirementsSortable() {
            const elRequirements = document.getElementById('requirements-list');
            if (!elRequirements) {
                return;
            }

            if (elRequirements.sortableInstance) {
                elRequirements.sortableInstance.destroy();
            }

            elRequirements.sortableInstance = Sortable.create(elRequirements, {
                animation: 200,
                ghostClass: 'bg-gray-200',
                handle: '.cursor-move',
                onEnd: () => {
                    const requirementsData = Array.from(elRequirements.querySelectorAll('li')).map((li, index) => ({
                        id: li.getAttribute('data-id'),
                        name: li.querySelector('input').value,
                        order: index + 1
                    }));

                    @this.reorder(requirementsData);
                }
            });
        }

        document.addEventListener('livewire:load', initRequirementsSortable);
        document.addEventListener('livewire:update', initRequirementsSortable);

        // Ejecutar inicialmente en caso de que el evento livewire:load ya se haya disparado
        initRequirementsSortable();

        function destroyRequirement(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.destroy(id);
                }
            })
        }
    </script>
    @endpush
</div>
