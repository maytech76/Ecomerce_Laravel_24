<x-admin-layout :breadcrumbs="[

     [
      'name'=>'Dashboard',
      'route'=> route('admin.dashboard'),
      
    ],

    [
      'name'=>'Sub-Categorias',
      'route'=> route('admin.subcategories.index'),
      
    ],

    [
      'name'=>'Nueva',
      
      
     ]
     
   ]">

    <div class="card">

        

        @livewire('admin.subcategories.subcategory-create')

    </div>
</x-admin-layout>