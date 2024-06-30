<div>
    <form wire:submit="store">
        
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
            <label class="felx items-center px-4 py-2 rounded-lg bg-white hover:bg-gray-600 text-gray-600 hover:text-white cursor-pointer">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar Imagen
                    <input type="file" class="hidden" wire:model="image" accept="image/*">
            </label>
            </div>
            <img class="aspect-[16/9] object-cover object-center w-full rounded-lg" 
            src="{{$image ? $image->temporaryUrl() : Storage::url($productEdit['images_path'])}}"
            alt="">
        </figure>

        {{-- Mensaje de errorres --}}
        <x-validation-errors class="mb-4"/>
            

        <div class="card">

             {{-- Codigo --}}
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Código
                </x-label>
                <x-input wire:model="productEdit.sku" class="w-full" placeholder="Ingresar codigo interno del producto"/>
            </div>
             
             {{-- //Nombre del producto --}}
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Nombre del Producto
                </x-label>
                <x-input wire:model="productEdit.name" class="w-full" placeholder="Ingresar nombre del producto"/>
            </div>
        
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Descripción detallada
                </x-label>
                <x-textarea
                    wire:model="productEdit.description"
                    class="w-full"
                    placeholder="Ingresar descrion detalla del producto">
                </x-textarea>
            </div>
        
             {{-- //Select Familia --}}
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Familias
                </x-label>
                
                <x-select class="w-full" wire:model.live="family_id">
        
                    <option value="" disabled>
                        Selecione una familia
                    </option>
        
                    @foreach ($families as $family )
                        <option value="{{$family->id}}"> {{$family->name}}</option>
                    @endforeach
                    
                </x-select>
        
            </div>
        
            {{-- //Select categorias --}}
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Categorias
                </x-label>
        
                <x-select class="w-full" wire:model.live="category_id">
        
                    <option value="" disabled>
                        Selecione una categoria
                    </option>
        
                    @foreach ($this->categories as $category )
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </x-select>
        
            </div>
        
            {{-- //Select Sub-categorias --}}
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Sub-Categorias
                </x-label>
        
                <x-select class="w-full" wire:model.live="productEdit.subcategory_id">
        
                    <option value="" disabled>
                        Selecione una Sub-Categoria
                    </option>
        
                    @foreach ($this->subcategories as $subcategory )
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                    @endforeach
                </x-select>
        
            </div>

              {{-- Precio del producto --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

                {{-- /precio del producto --}}
                <div class="mb-4">
                    <x-label class="mb-2 font-semibold">
                        Precio de Producto
                    </x-label>
                        <x-input 
                            type="number"
                            step="0.01"
                            wire:model="productEdit.price"
                            class="w-full"
                            placeholder="Ingresar precio del producto">
                        </x-input>
                </div>
            
            @empty($product->variants->count() > 0 ) {{-- si las variantes del producto son menos que 0, mostrar Stock --}}  
                
                {{-- /Stock del producto --}} 
                <div class="mb-4 w-50">
                    <x-label class="mb-2 font-semibold">
                        Stock del Producto
                    </x-label>
                    <x-input 
                        type="number"
                        wire:model="productEdit.stock"
                        class="w-full"
                        placeholder="Ingresar el stock del producto">
                    </x-input>
                </div>
        
            @endempty

            </div>

            <div class="flex justify-end">

                <x-danger-button class="mt-2" onclick="confirmDelete()">
                  Eliminar
                </x-danger-button>
 
                 <x-button type="submit" class="mt-2 ml-2">
                     Actualizar
                 </x-button>
             </div>

        </div>

    </form>
    

    <form action="{{route('admin.products.destroy', $product)}}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
     </form>

        {{-- //Enviar Funciones y metodos de javascrip a plantilla admin --}}
    @push('js')

        <script>
        function confirmDelete(){

            /* Mensaje sweealert para confirmar la ejecucion delete */

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
</div>

