<div 
    x-cloack 
    x-show="open" 
    @click="open = false" 
    class="fixed inset-0 z-40 bg-gray-900/50 sm:hidden"
    x-transition.opacity>
</div>
@php
   $links =[
      [
         'name' => 'Dashboard',     
         'icon' => 'fa-solid fa-gauge',
         'route' => route('admin.dashboard'),
         'active' => request()->routeIs('admin.dashboard'),
      ],
       [
         'name' => 'Users',     
         'icon' => 'fa-solid fa-users',
         'route' => '',
         'active' => false,
      ],
      [
         'header' => 'Management',
      ],

      [
         'name' => 'Posts',     
         'icon' => 'fa-solid fa-file',
         'active' => false,
         'submenu' => [
            [
               'name' => 'information',
               'icon' => 'fa-solid fa-circle-info',
               'route' => '',
               'active' => false,   
            ],
            [
               'name' => 'information',
               'icon' => 'fa-solid fa-circle-info',
               'route' => '',
               'active' => false,   
            ],
         ]
      ],

   ];
@endphp

<aside id="top-bar-sidebar" class="fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar"
:class="{
   'transform-none': open,
   '-translate-x-full': !open,
}">
   <div class="h-full px-3 py-4 overflow-y-auto bg-white border-e border-default">

      <a href="#" class="flex items-center ps-2.5 mb-5">
         <img src="#" class="h-6 me-3" alt="CodersFree" />
         <span class="self-center text-lg text-heading font-semibold whitespace-nowrap">CodersFree</span>
      </a>
      
    <ul x-cloack class="space-y-2 font-medium">
         @foreach ($links as $link)
            
            @if(isset($link['header']))
               <li class="px-3 py-2 mt-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                  {{ $link['header'] }}
               </li>

            @elseif(isset($link['submenu']))
               <li x-data="{ submenuOpen: {{ $link['active'] ? 'true' : 'false' }} }">
                  <button @click="submenuOpen = !submenuOpen" type="button" class="flex items-center w-full px-2 py-1.5 text-gray-900 rounded-lg hover:bg-gray-100 group {{ $link['active'] ? 'bg-gray-100' : '' }}">
                     <span class="inline-flex items-center justify-center w-5 h-5 text-gray-500 transition duration-75 group-hover:text-blue-600">
                        <i class="{{ $link['icon'] }} text-lg"></i>
                     </span>
                     <span class="flex-1 ms-3 text-left whitespace-nowrap">{{ $link['name'] }}</span>
                     
                     <svg class="w-3 h-3 transition-transform duration-200" :class="{'rotate-180': submenuOpen}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                     </svg>
                  </button>
                  
                  <ul x-cloack x-show="submenuOpen" x-transition class="py-2 space-y-2">
                     @foreach($link['submenu'] as $sublink)
                        <li>
                           <a href="{{ $sublink['route'] ?? '#' }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 {{ isset($sublink['active']) && $sublink['active'] ? 'text-blue-600 bg-gray-50' : '' }}">
                              {{ $sublink['name'] }}
                           </a>
                        </li>
                     @endforeach
                  </ul>
               </li>

            @else
               <li>
                  <a href="{{ $link['route'] ?? '#' }}" class="flex items-center px-2 py-1.5 text-gray-900 rounded-lg hover:bg-gray-100 group {{ isset($link['active']) && $link['active'] ? 'bg-gray-100' : '' }}">
                     <span class="inline-flex items-center justify-center w-5 h-5 text-gray-500 transition duration-75 group-hover:text-blue-600">
                        <i class="{{ $link['icon'] }} text-lg"></i>
                     </span>
                     <span class="ms-3">{{ $link['name'] }}</span>
                  </a>
               </li>
            @endif

         @endforeach
      </ul>
   </div>
</aside>