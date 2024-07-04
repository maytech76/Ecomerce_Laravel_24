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
      'name' => 'Editar'
    ]
     
   ]">

   
<form action="{{route('admin.covers.update', $cover)}}" 
    method="POST" 
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <figure class="relative mb/4">

        <div class="absolute top-8 right-8">
            <label class="felx items-center px-4 py-2 rounded-lg bg-white hover:bg-gray-600 text-gray-600 hover:text-white cursor-pointer">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar Imagen
                    <input type="file" name="image" class="hidden" accept="image/*" onchange="previewImage(event, '#imgPortada')">
            </label>
        </div>

         <img id="imgPortada" src="{{ $cover->image }}" alt="portada" class="w-full aspect-[3/1] object-cover object-center">

    </figure>

    {{-- mostrar Si existen errores --}}
    
    <x-validation-errors class="mb-4" :errors="$errors"/>   

    {{-- label & Input --}}
    <div class="m-4">

    <x-label class="mb-2 font-semibold">
      Titulo de Portada
    </x-label>

    <x-input type="text" class="w-full" value="{{old('title', $cover->title)}}" name="title" placeholder="Por Favor ingrese el titulo de la portada"></x-input>

    </div>

    {{-- Fechas Inicio-Fin --}}
    <div class="m-4 grid grid-cols-1 md:grid-cols-2 gap-3">

    <div class="">
        <x-label class="mb-2 font-semibold">
          Fecha de Inicio
        </x-label>

        <x-input type="date" class="w-full" value="{{old('star_at', $cover->star_at->format('Y-m-d'))}}" name="star_at"></x-input>
    </div>

    <div class="">
        <x-label class="mb-2 font-semibold">
          Fecha de Final de la Publicidad
        </x-label>

        {{-- muestra su valor, si en el campo end_at existe registro, muestrame el registro con el format, caso contrario muestra un campo vacio --}}
        <x-input type="date" class="w-full" value="{{old('end_at', $cover->end_at ? $cover->end_at->format('Y-m-d'): '')}}" name="end_at"></x-input>
    </div>

    </div>

    {{-- Activo-Inactivo --}}
    <div class="m-4 flex space-x-2">
    <label>
        <x-input type="radio" name="is_active" value="1" :checked="$cover->is_active == 1"/>    
        Activo 
    </label>

    <label>
        <x-input type="radio" name="is_active" value="0" :checked="$cover->is_active == 0"/>    
        Inactivo 
    </label>
    </div>

    {{-- Boton de accion --}}
    <div class="flex justify-end mb-6">
      <x-button>
        ~ | Actualizar
      </x-button>
    </div>

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