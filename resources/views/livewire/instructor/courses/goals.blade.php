<div>
    @if (count($goals))
        <ul class="space-y-3 mb-4" id="goals">
            @foreach ($goals as $goalId => $goal)
                <li wire:key="goal-{{ $goalId }}" data-id="{{ $goalId }}">
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500 transition bg-white">

                        <x-input
                            wire:model.live="goals.{{ $goalId }}.name"
                            class="flex-1 border-none shadow-none focus:ring-0 rounded-none py-2 px-3 text-gray-700"
                        />

                        <div class="flex items-stretch bg-gray-50 border-l border-gray-300 divide-x divide-gray-300">
                            <button
                                onClick="destroyGoal({{ $goalId }})"
                                type="button"
                                class="text-red-400 hover:text-red-600 px-3 py-2 transition-colors duration-200"
                                title="Eliminar meta"
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
                Actualizar
            </x-button>
        </div>
    @endif

    <form wire:submit.prevent="store">
        <x-input wire:model="name" class="w-full" placeholder="Ingrese el nombre de la meta" />
        <x-input-error for="name" />

        <div class="flex justify-end mt-2">
            <x-button>
                Agregar meta
            </x-button>
        </div>
    </form>

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.7/Sortable.min.js"></script>
    <script>
        const el = document.getElementById('goals');
        if (el) {
            Sortable.create(el, {
                animation: 200,
                ghostClass: 'bg-gray-200',
                handle: '.cursor-move',
                onEnd: () => {

                    let goalsData = Array.from(el.querySelectorAll('li')).map((li, index) => {
                        return {
                            id: li.getAttribute('data-id'),
                            name: li.querySelector('input').value,
                            order: index + 1
                        };
                    });

                    @this.reorder(goalsData);
                }
            });
        }

        function destroyGoal(id) {
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
