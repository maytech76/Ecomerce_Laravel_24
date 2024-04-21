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
      'name'=>$category->name,
      
      
     ]
     
   ]">

<div class="card">

    <form action="{{route('admin.categories.update', $category)}}" method="POST">

        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4"/>

        <div class="mb-4">
          <x-label class="mb-2 font-semibold">
             Familia :
          </x-label>

          <x-select name="family_id" class="w-full">
            @foreach ($families as $family )
              <option value="{{$family->id}}" 
                  @selected(old('family_id', $category->family_id) == $family->id)>
                {{$family->name}}
              </option>
            @endforeach
          </x-select>
        </div>

        <div class="">
            <x-label class="mb-2 font-semibold">
                Nombre :
            </x-label>
            <x-input class="w-full" placeholder="ingresar nombre de la Categoria.." name="name" value="{{old('name', $category->name)}}"/>
        </div>

    
            <div class="flex justify-end">

                <x-danger-button class="mt-2 bg-red-400 text-black hover:bg-red-700 hover:text-gray-100" onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>

                <x-button type="submit" class="btn btn-verde mt-2 ml-2 bg-yellow-400 text-black hover:bg-yellow-600 hover:text-gray-100">
                    Registrar
                </x-button>
            </div>

    </form>
</div>

    {{-- Formulario donde se aplicara el metodo 'DELETE' --}}
    <form action="{{route('admin.categories.destroy', $category)}}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    {{-- //Enviar Funciones y metodos de javascrip a plantilla admin --}}
    @push('js')

        <script>
        function confirmDelete(){

            /*  */

            Swal.fire({
            title: "Estas Seguro?",
            text: "Este Proceso es Inrebersible!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Eliminar!",
            cancelButtonText: "Cancelar"
            }).then((result) => {
            if (result.isConfirmed) {
                
                document.getElementById('delete-form').submit();
                }
            });

        }
        </script>
    
    @endpush


</x-admin-layout>