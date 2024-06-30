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

    <form action="" method="POST">
        @csrf
        <div class="relative mb-6">
            <figure>
               <img  class="aspect-[16/9] w-full object-cover object-center rounded-md" src="{{$variant->image}}" id="imgVar">
            </figure>
      
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

        <div class="card">
            <div class="mb-4">

                <x-label class="mb-2">
                    Código (SKU)
                </x-label>

                <x-input
                  name="sku"
                  value="{{ old('sku', $variant->sku) }}"
                  placeholder="Ingresar Código SKU"
                  class="w-1/2"/>
                        
            </div>
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