<div class="max-w-4xl mx-auto py-6 sm:py-8 px-3 sm:px-4" x-init="$nextTick(() => initSortable())">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2 sm:gap-0">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Secciones del Curso</h2>
        <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-3 py-1 rounded-full self-start sm:self-auto">
            {{ count($sections) }} {{ count($sections) === 1 ? 'Sección' : 'Secciones' }}
        </span>
    </div>

    <hr class="border-gray-200 mb-6">

    <ul x-ref="sortableList" class="mb-4 space-y-4"> @include('instructor.sections.create', ['position' => 1])

        @forelse ($sections as $section)
            <li wire:key="section-{{ $section->id }}" data-id="{{ $section->id }}" class="sortable-item">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:px-6 sm:py-4">
                    @if ($sectionEdit['id'] == $section->id)
                        @include('instructor.sections.edit')
                    @else
                        @include('instructor.sections.show')
                    @endif
                    <div class="mt-3"> @livewire('instructor.courses.manage-lessons', [
                            'section' => $section,
                            'lessons' => $section->lessons
                        ], key('section-lessons-' . $section->id))
                    </div>
                </div>
                @include('instructor.sections.create', ['position' => $loop->iteration + 1])
            </li>
        @empty
            <li class="bg-gray-50 rounded-lg px-4 py-8 sm:px-6 sm:py-10 text-center border-2 border-dashed border-gray-300 ignore-sort">
            </li>
        @endforelse
    </ul>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.7/Sortable.min.js"></script>
<script>
    function initSortable() {
        const sortableList = document.querySelector('[x-ref="sortableList"]');
        if (!sortableList) {
            return;
        }

        if (sortableList.sortableInstance) {
            sortableList.sortableInstance.destroy();
        }

        sortableList.sortableInstance = Sortable.create(sortableList, {
            animation: 200,
            ghostClass: 'bg-gray-200',
            handle: '.drag-handle',
            filter: '.ignore-sort',
            onEnd: () => {
                const items = Array.from(sortableList.querySelectorAll('li[data-id]')).map(li => li.getAttribute('data-id'));

                @this.updateSortOrder(items);
            }
        });
    }

    document.addEventListener('livewire:load', initSortable);
    document.addEventListener('livewire:update', initSortable);


    initSortable();
</script>
@endpush
