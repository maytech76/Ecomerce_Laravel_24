<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Dashboard',
        'route'=> route('admin.dashboard'),
    ],
    [
        'name'=>'Productos',
        'route'=> route('admin.products.index'),
    ],
    [
        'name'=>$product->name,
        'route'=> route('admin.products.edit', $product),
    ],

    [
        'name' => $variant->features->pluck('description')->implode(' -|- '),
    ]
]">

    <form action="{{route('admin.products.variantsUpdate', [$product, $variant])}}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4"/>  

        <div class="relative mb-6">
            <figure>
               <img  class="aspect-[16/9] w-full object-cover object-center rounded-md" src="{{$variant->image}}" id="imgVar">
            </figure>
      
            {{-- Seccion para imagen --}}
            <div class="absolute top-8 right-8">
                <label class="flex items-center bg-white hover:bg-slate-600 hover:text-white px-4 py-2 rounded-lg cursor-pointer">
                   <i class="fas fa-camera mr-2"></i>
                   Actualizar Imagen
      
                   <input class="hidden" 
                          type="file" 
                          accept="image/*" 
                          name="image" 
                          onchange="previewImage(event, '#imgVar')">
                </label>
      
            </div>
        </div>

       <div class="flex-auto">
          
        <div class="card grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Session codigo Sku --}}
                <div class="mb-2">

                    <x-label class="mb-2 font-semibold">
                        Código (SKU)
                    </x-label>

                    <x-input
                    name="sku"
                    value="{{ old('sku', $variant->sku) }}"
                    placeholder="Ingresar Código SKU"
                    class="w-full"/>
                            
                </div>
      

                {{-- Session Stock de Producto --}}
                <div class="mb-2">

                    <x-label class="mb-2 font-semibold">
                        Stock
                    </x-label>

                    <x-input
                    name="stock"
                    value="{{ old('stock', $variant->stock) }}"
                    placeholder="Ingresar Stock"
                    class="w-full"/>
                            
                </div>
         </div>{{-- end card --}}
       </div>

       <div class="flex justify-end mt-4">
        <x-button class="bg-yellow-500 text-black hover:bg-yellow-700 hover:text-yellow-100">
            Actualizar
        </x-button>
       </div>

    </form>

  @push('js')

    <script>
            function previewImage(event, querySelector){

            //Recuperamos el input que desencadeno la acción
            const input = event.target;

            //Recuperamos la etiqueta img donde cargaremos la imagen
            const imgPreview = document.querySelector(querySelector);

            // Verificamos si existe una imagen seleccionada
            if(!input.files.length) return

            //Recuperamos el archivo subido
            const file = input.files[0];

            //Creamos la url
            const objectURL = URL.createObjectURL(file);

            //Modificamos el atributo src de la etiqueta img
            imgPreview.src = objectURL;
                    
         }
    </script>
      
  @endpush

</x-admin-layout>