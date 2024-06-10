<x-admin-layout :breadcrumbs="[

     [
      'name'=>'Dashboard',
      'route'=> route('admin.dashboard'),
      
    ],

    [
      'name'=>'Opciones',
      
     ]
     
   ]">


   {{-- Agregamos el componente livewire que nos permitira crear la vista dinamica de Opciones --}}
   @livewire('admin.options.manage-options')
   
   </x-admin-layout>
