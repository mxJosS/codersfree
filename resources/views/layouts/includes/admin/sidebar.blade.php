<div 
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
         'route' => '',
         'active' => false,
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
      
      <ul class="space-y-2 font-medium">
         @foreach ($links as $link)
          <li>
           @isset($link['header'])
           <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ $link['header'] }}</div>
              @else
                <a href="{{ $link['route'] }}" class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ $link['active'] ? 'bg-gray-100' : '' }}">
               
               <span class="inline-flex items-center justify-center w-5 h-5 text-gray-500 transition duration-75 group-hover:text-fg-brand">
                  <i class="{{ $link['icon'] }} text-lg text-gray-500"></i>
               </span>
               
               <span class="ms-3">{{ $link['name'] }}</span>
            </a>
           @endisset
           
           
         </li>
         @endforeach
      </ul>
   </div>
</aside>