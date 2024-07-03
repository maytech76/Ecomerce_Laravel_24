<x-admin-layout :breadcrumbs="[

     [
      'name'=>'Dashboard',
      'route'=> route('admin.dashboard'),
      
    ],

    [
      'name'=>'Portadas',
      'route' => route('admin.covers.index'),
      
    ],

     [
       'name' =>'Nuevo',
     ]

     /* Formulario para gestionar portadas */

     
     ]">

     <form acttion="{{route('admin.covers.create')}}" method="POST">
        @csrf
        <figure class="relative">

            <div class="absolute top-8 right-8">
                <label class="felx items-center px-4 py-2 rounded-lg bg-white hover:bg-gray-600 text-gray-600 hover:text-white cursor-pointer">
                        <i class="fas fa-camera mr-2"></i>
                        Actualizar Imagen
                        <input type="file" name="image" class="hidden" accept="image/*" onchange="previewImage(event, '#imgPortada')">
                </label>
                </div>

            <img id="imgPortada" src="{{asset('img/no_portada.webp')}}" alt="portada" class="w-full aspect-[3/1] object-cover object-center">
        </figure>
     </form>

     @push('js')

     <script>
        function previewImage(event, querySelector){

        //Recuperamos el input que desencadeno la acción
        const input = event.target;

        //Recuperamos la etiqueta img donde cargaremos la imagen
        $imgPreview = document.querySelector(querySelector);

        // Verificamos si existe una imagen seleccionada
        if(!input.files.length) return

        //Recuperamos el archivo subido
        file = input.files[0];

        //Creamos la url
        objectURL = URL.createObjectURL(file);

        //Modificamos el atributo src de la etiqueta img
        $imgPreview.src = objectURL;
                    
        }
     </script>
         
     @endpush

</x-admin-layout>