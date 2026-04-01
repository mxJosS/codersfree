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
    <ul class="space-y-2 mb-4">
        @foreach ($goals as $index => $goal)
            <li wire:key="goal-{{ $goal['id'] }}" class="flex items-center gap-2">

                <x-input
                    wire:model="goals.{{ $index }}.name"
                    class="w-full"
                />

                <button type="button" class="text-red-500 p-2">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </li>
        @endforeach
    </ul>

    <div class="flex justify-end mb-8">
        <x-button wire:click="update">
            Actualizar
        </x-button>
    </div>

    <form wire:submit.prevent="store">
        <x-input wire:model="name" class="w-full" placeholder="Ingrese el nombre de la meta" />
        <x-input-error for="name" />

        <div class="flex justify-end mt-2">
            <x-button>
                Agregar meta
            </x-button>
        </div>
    </form>





</div>
