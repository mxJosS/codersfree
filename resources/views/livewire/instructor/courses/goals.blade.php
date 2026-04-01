<div>


    {{-- [
        [
            'id' => 1,
            'name' => 'Meta 1'
        ],
        [
            'id' => 2,
            'name' => 'Meta 2'
        ]
    ] --}}
 @if (count($goals))
      <ul class="space-y-3 mb-4">
        @foreach ($goals as $index => $goal)
            <li wire:key="goal-{{ $goal['id'] }}">
                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500 transition">

                    <x-input
                        wire:model="goals.{{ $index }}.name"
                        class="flex-1 border-none shadow-none focus:ring-0 rounded-none py-2 px-3 text-gray-700"
                    />

                    <div class="flex items-center bg-gray-50 border-l border-gray-300 h-full">
                        <button
                            onClick="destroyGoal({{ $goal['id'] }})"
                            type="button"
                            class="text-red-400 hover:text-red-600 px-4 py-2 transition-colors duration-200"
                            title="Eliminar meta"
                        >
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
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
<script>
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
