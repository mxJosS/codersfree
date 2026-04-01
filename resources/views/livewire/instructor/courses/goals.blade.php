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
    <ul class="space-y-2 mb-8">
        @foreach ($goals as $goal)
            <li wire:key="goal-{{ $goal->id }}" class="flex items-center gap-2">
                <x-input class="w-full" value="{{ $goal->name }}" readonly />

                <button type="button" class="text-red-500 p-2">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </li>
        @endforeach
    </ul>



    <form wire:submit="store">
        <div class="bg-gray-100 rounded-lg shadow-lg p-6">
            <x-label class="mb-2">
                Nueva meta
            </x-label>

            <x-input wire:model="name" class="w-full" placeholder="Ingrese la nueva meta">
            </x-input>
            <x-input-error for="name" class="mt-2" />
            <div class="flex justify-end mt-4">
                <x-button class="mt-4" wire:click="store">
                    Agregar meta
                </x-button>
            </div>
        </div>
    </form>





</div>
