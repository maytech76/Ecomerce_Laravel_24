<div class="bg-white py-12">

    <x-container class="px-4 md:flex">
        
        {{-- Menu de Opciones --}}
        @if (count($options))
            <aside class="md:w-52 md:flex-shrink-0 md:mr-8 mb-4 md:mb-0">
                    <ul class="space-y-6">
                        @foreach ( $options as $option )

                            <li x-data="{open: true}">
                            <button class="rounded-sm px-4 py-2 bg-slate-300 w-full text-left text-gray-800 flex justify-between items-center" x-on:click="open = !open">

                                {{ $option->name }}

                                <i class="fa-solid fa-angle-down"
                                    x-bind:class="{
                                    'fa-solid fa-angle-down': open,
                                    'fa-solid fa-angle-right': !open
                                    }"
                                    ></i>

                            </button>

                            <ul class="mt-2 space-y-2" x-show="open">
                                @foreach ( $option->features as $feature )
                                    <li>
                                        <label class="inline-flex items-center">

                                            <x-checkbox class="mr-2"/> 

                                            {{ $feature->description }}

                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                            </li>
                            
                        @endforeach
                    </ul>
            </aside>
        @endif

        
 
        
        <div class="md:flex-1">{{-- Inicio Sesion de Productos --}}
           
            {{-- Componente Select para aplicar filtros por precio --}}
            <div class="ml-4 flex-1 mb-4">
                <span class="mr-3">
                Ordenar por: 
                </span>
    
                <x-select>
                    <option value="1">Relevancia</option>
                    <option value="2">Precio: de Mayor a Menor</option>
                    <option value="2">Precio: de Menor a Mayor</option>
                </x-select>
    
            </div>

            <hr class="my-4">

            {{-- Listado de productos --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mx-4">

                @foreach ( $products as  $product)
                
                    {{--  Diseño de Tarjeta por Producto --}}
                    <article class="bg-white shadow-md rounded overflow-hidden mb-6">
                        
                        <img src="https://ecomerce.test/storage/{{$product->images_path}}" 
                            class=" w-full h-48 object-cover object-center">
                        
                            <div class="p-4">
                                <h1 class="text-gray-600 line-clamp-2 mb-2 min-h-[56px]"> {{$product->name}} </h1>

                                <p class="text-gray-700 mb-4 font-semibold">
                                $ {{$product->price}}
                                </p>

                                <a href="" class="btn btn-rosa block w-full text-center font-extralight">
                                    Más información
                                </a>
                            </div>                  
                    </article>  
                                
                @endforeach
            </div>

            <div class="mt-6">{{$products->links()}} </div>

        </div>{{-- Fin Session de Productos --}}

    </x-container>
   
</div>
