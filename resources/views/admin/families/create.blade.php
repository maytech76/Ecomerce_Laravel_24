<x-admin-layout :breadcrumbs="[

     [
      'name'=>'Dashboard',
      'route'=> route('admin.dashboard'),
      
    ],

    [
      'name'=>'Familias',
      'route'=> route('admin.families.index'),
      
    ],

    [
      'name'=>'Nuevo',
      
      
     ]
     
   ]">

   <div class="card">

    <form action="{{route('admin.families.store')}}" method="POST">

        @csrf

        <div class="">
            <x-label class="mb-2">
                Nombre
            </x-label>
            <x-input class="w-full" placeholder="Ingresar Nombre de la Familia.." name="name" value="{{old('name')}}"/>
        </div>

    
            <div class="flex justify-end">
                <x-button type="submit" class="btn btn-verde mt-2">
                    Registrar
                </x-button>
            </div>

    </form>

   </div>



</x-admin-layout>