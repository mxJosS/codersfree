@props(['course'])

<div
    x-data="{ uploading: false, progress: 0 }"
    x-on:livewire-upload-start="uploading = true"
    x-on:livewire-upload-finish="uploading = false"
    x-on:livewire-upload-cancel="uploading = false"
    x-on:livewire-upload-error="uploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    <div class="flex items-center justify-center w-full">
        <label class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all duration-200">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                {{-- Icono de la nube (Cloud Upload) --}}
                <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haz clic para subir video promocional</span></p>
                <p class="text-xs text-gray-400">MP4, MKV o MOV (Máx. 512MB)</p>
            </div>

            <input type="file" {{ $attributes }} class="hidden" accept="video/*">
        </label>
    </div>

    {{-- Barra de progreso con diseño estilo Vitalia --}}
    <div x-show="uploading" class="mt-4">
        <div class="flex justify-between mb-1">
            <span class="text-xs font-medium text-indigo-700">Subiendo archivo...</span>
            <span class="text-xs font-medium text-indigo-700" x-text="progress + '%'"></span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-indigo-600 h-2 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
        </div>
    </div>
</div>
