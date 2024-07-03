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
            src="{{$image ? $image->temporaryUrl() : asset('img/not_image.png')}}"
            alt="">
        </figure>

        {{-- Mensaje de errorres --}}
        <x-validation-errors class="mb-4"/>
            

        <div class="card">

            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Código
                </x-label>
                <x-input wire:model="product.sku" class="w-full" placeholder="Ingresar codigo interno del producto"/>
            </div>
        
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Nombre del Producto
                </x-label>
                <x-input wire:model="product.name" class="w-full" placeholder="Ingresar nombre del producto"/>
            </div>
        
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Descripción detallada
                </x-label>
                <x-textarea
                    wire:model="product.description"
                    class="w-full"
                    placeholder="Ingresar descrion detalla del producto">
                </x-textarea>
            </div>
        
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
        
                <x-select class="w-full" wire:model.live="product.subcategory_id">
        
                    <option value="" disabled>
                        Selecione una Sub-Categoria
                    </option>
        
                    @foreach ($this->subcategories as $subcategory )
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                    @endforeach
                </x-select>
        
            </div>

            {{-- /precio del producto --}}
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Precio
                </x-label>
                    <x-input 
                        type="number"
                        step="0.01"
                        wire:model="product.price"
                        class="w-full"
                        placeholder="Ingresar precio del producto">
                    </x-input>
            </div>

            <div class="flex justify-end">
                  <x-button>
                     Registrar
                  </x-button>
            </div>

        </div>

    </form>
</div>
