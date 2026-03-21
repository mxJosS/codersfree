@if (isset($breadcrumb) && count($breadcrumb) > 0)
  <nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
      
      @foreach ($breadcrumb as $item)
        <li @if($loop->last) aria-current="page" @endif>
            <div class="flex items-center space-x-1.5">
                
                @if ($loop->first)
                    <svg class="w-4 h-4 me-1.5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/></svg>
                @else
                    <svg class="w-3.5 h-3.5 rtl:rotate-180 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg> 
                @endif
                
                @if ($loop->last || empty($item['url']))
                    <span class="inline-flex items-center text-sm font-medium text-gray-500">
                        {{ $item['name'] ?? 'Sin nombre' }}
                    </span>
                @else
                    <a href="{{ $item['url'] }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        {{ $item['name'] ?? 'Sin nombre' }}
                    </a>
                @endif

            </div>
        </li>
      @endforeach
      
    </ol>
  </nav>  
@endif