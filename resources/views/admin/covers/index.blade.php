<x-admin-layout :breadcrumbs="[

     [
      'name'=>'Dashboard',
      'route'=> route('admin.dashboard'),
      
    ],

    [
      'name'=>'Portadas',
      
     ]
     
   ]">

    {{-- Boton Nuevo Covers --}}
    <x-slot name="action">
 
        <a class="btn btn-azul" href="{{route('admin.covers.create')}}">
            + Nuevo
          </a>
          
    </x-slot>

    <ul class="space-y-4">
      @foreach ( $covers as $cover )

       <li class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex lg:pr-4">
         
         <img src="{{$cover->image}}" class="w-full lg:w-64 aspect-[3/1] object-cover object-center">
         
            <div class="-p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center">

                  <div class="p-4 text-center">
                      <h1 class="font-semibold"> {{$cover->title}} </h1>
                      <p>
                        @if ($cover->is_active){{-- ¿el valor del campo is_active es true? --}}
                           {{-- Si es true muestra la este estilo green con la palabra activa --}}
                          <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">Activa</span>
                        @else
                          {{-- Si es false muestra la este estilo red con la palabra inactiva --}}
                          <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Inactiva</span>
                        @endif
                      </p>
                  </div>
      
                  <div class="mb-2 flex space-x-6 justify-around">

                      <div class="text-center">

                          <p class="text-sm font-bold">Fecha de Inicio</p>
      
                          <p> <span class="text-gray-600 text-xs"> {{$cover->star_at->format('d/m/y')}}</span> </p>
    
                      </div>
    
    
                      <div class="text-center">

                          <p class="text-sm font-bold">Fecha Final</p>
                                  {{-- Existe registro en el campo end_at, SI! ok muestra el valor con formato d-m-y, NO..! muestra el texto 'No definida' --}}
                          <p> <span class="text-red-500 text-xs"> {{$cover->end_at ?  $cover->end_at->format('d/m/y') : 'No definida'}}</span> </p>

                      </div>
                  </div>

                  <div class="btn btn-amarillo">
                     <a href="{{route('admin.covers.edit', $cover)}}"> <p class="text-center">Editar</p></a>
                  </div>
            </div>

       </li>
        
      @endforeach
    </ul>

</x-admin-layout>