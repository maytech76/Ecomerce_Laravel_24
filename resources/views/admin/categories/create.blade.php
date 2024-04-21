<x-admin-layout :breadcrumbs="[

     [
      'name'=>'Dashboard',
      'route'=> route('admin.dashboard'),
      
    ],

    [
      'name'=>'Categorias',
      'route'=> route('admin.categories.index'),
      
    ],

    [
      'name'=>'Nueva',
      
      
     ]
     
   ]">

<div class="card">

    <form action="{{route('admin.categories.store')}}" method="POST">

        @csrf

        <x-validation-errors class="mb-4"/>

        <div class="mb-4">
          <x-label class="mb-2 font-semibold">
             Familia :
          </x-label>

          <x-select name="family_id" class="w-full">
            @foreach ($families as $family )
              <option value="{{$family->id}}"
                @selected(old('family_id') == $family->id)>
                >{{$family->name}}
              </option>
            @endforeach
          </x-select>
        </div>

        <div class="">
            <x-label class="mb-2 font-semibold">
                Nombre :
            </x-label>

            <x-input class="w-full" placeholder="ingresar nombre de la Categoria.." name="name" value="{{old('name')}}"/>
        </div>

    
            <div class="flex justify-end">
                <x-button type="submit" class="btn btn-verde mt-2">
                    Registrar
                </x-button>
            </div>

    </form>

</div>

</x-admin-layout>