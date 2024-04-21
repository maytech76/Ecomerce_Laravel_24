<x-admin-layout :breadcrumbs="[

     [
      'name'=>'Dashboard',
      'route'=> route('admin.dashboard'),
      
    ],

    [
      'name'=>'Familias',
      'route'=>route('admin.families.index'),
      
    ],

    [
        'name'=>$family->name,
    ]
     
   ]">

<div class="card">

    <form action="{{route('admin.families.update', $family)}}" method="POST">

        @csrf
        @method('PUT')

        <div class="">
            <x-label class="mb-4">
                Nombre
            </x-label>

            <x-input class="w-full" placeholder="ingresar nombre de la familia.." name="name" value="{{old('name', $family->name)}}"/>
        </div>

    
            <div class="flex justify-end">

               <x-danger-button class="mt-2" onclick="confirmDelete()">
                 Eliminar
               </x-danger-button>

                <x-button type="submit" class="mt-2 ml-2">
                    Actualizar
                </x-button>
            </div>

    </form>

</div>

<form action="{{route('admin.families.destroy', $family)}}" method="POST" id="delete-form">
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

