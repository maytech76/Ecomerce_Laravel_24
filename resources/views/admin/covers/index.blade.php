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

</x-admin-layout>