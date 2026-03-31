<div>
    @push('css')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.8.4/plyr.css" />
    @endpush

    <h1 class="text-2xl font-bold mb-4">Video promocional</h1>
    <hr class="mt-2 mb-6">

    <div class="grid grid-cols-2 gap-6">
        <div class="col-span-1">
            @if ($course->video_path && !$video)
                <div wire:ignore>
                    <video id="player" playsinline controls>
                        <source src="{{ Storage::url($course->video_path) }}" type="video/mp4">
                    </video>
                </div>
            @elseif ($video)
                <div class="aspect-video bg-black rounded-lg flex items-center justify-center overflow-hidden shadow-md">
                    <video class="w-full h-full" controls src="{{ $video->temporaryUrl() }}"></video>
                </div>
                <p class="text-xs text-gray-500 mt-2 text-center italic">Vista previa del archivo seleccionado</p>
            @else
                <figure>
                    <img class="aspect-video w-full object-cover rounded-lg shadow-sm" src="{{ $course->image }}" alt="{{ $course->title }}">
                </figure>
            @endif
        </div>

        <div class="col-span-1">
            <form wire:submit.prevent="save">
                <x-instructor.progress-indicators wire:model="video" :course="$course" />

                <div class="flex justify-end items-center mt-4 gap-2">
                    <button type="button"
                        @disabled(!$course->video_path)
                        x-on:click="
                            Swal.fire({
                                title: '¿Estás seguro?',
                                text: '¡El video se eliminará permanentemente!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#4f46e5',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Sí, eliminar',
                                cancelButtonText: 'Cancelar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $wire.destroy();
                                }
                            })
                        "
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25 shadow-sm">

                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Eliminar video
                    </button>

                    <x-button type="submit" wire:loading.attr="disabled" wire:target="video">
                        Subir video
                    </x-button>
                </div>

                <x-input-error for="video" class="mt-2" />
            </form>

            <div class="mt-4 text-sm text-gray-600">
                <p>Sube un video corto que describa tu curso. Los estudiantes suelen decidir su compra basándose en este video.</p>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.plyr.io/3.8.4/plyr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function initPlyr() {
            if (document.getElementById('player')) {
                new Plyr('#player');
            }
        }
        document.addEventListener('DOMContentLoaded', initPlyr);
        document.addEventListener('livewire:navigated', initPlyr);

        window.addEventListener('saved', () => {
            setTimeout(initPlyr, 100);
        });

        window.addEventListener('swal', (event) => {
            const data = event.detail[0];
            Swal.fire({
                icon: data.icon,
                title: data.title,
                text: data.text,
                confirmButtonColor: '#4f46e5',
            });
        });
    </script>
@endpush
