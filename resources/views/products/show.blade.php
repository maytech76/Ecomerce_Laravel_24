<x-app-layout>

    <x-container px-4>
        
        <nav class="flex mt-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                
                {{-- Inicio --}}
                <li class="inline-flex items-center">
                    <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Inicio
                    </a>
                </li>

                {{-- Nombre y vinculo de Familia --}}
                <li>
                    <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="{{$product->subcategory->category->family->id}}" class="ms-1 text-sm font-medium text-gray-700 hover:text-red-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                      {{$product->subcategory->category->family->name}} </a>
                    </div>
                </li> 

                {{--  Nombre - Categoria --}}
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                        {{$product->subcategory->category->name}}</span>
                    </div>
                </li>

                {{--  Nombre - subCategoria --}}
                <li aria-current="page">
                    <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                        {{$product->subcategory->name}}</span>
                    </div>
                </li>

            </ol>
        </nav>
  
    </x-container>
    

      <x-container>
            <div class="card mt-4">
                <div class="grid md:grid-cols-2 gap-6">

                    {{-- columna Izquierda --}}
                    <div class="col-span-1">

                        <figure class="mb-2">
                            <img src="https://ecomerce.test/storage/{{$product->images_path}}" class="aspect-[16/9] w-full object-cover object-center rounded-lg shadow-md">
                        </figure>
                        <div class="text-sm text-gray-600">
                            {{$product->description}}
                        </div>

                    </div>

                    {{-- columna Derecha --}}
                    <div class="col-span-1">

                        <h1 class="text-xl text-gray-700 mb-2">
                            {{$product->name}}
                        </h1>

                        <div class="flex space-x-2 items-center mb-4">
                            <ul class="flex space-x-1 text-sm">
                                <li>
                                    <i class="fa-solid fa-star text-yellow-400  text-sm"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                </li>
                            </ul>
                               
                                <p class="text-gray-600">7.8<span class="px-2">(55)</span></p>
                      
                        </div>
                        
                       <div class="flex space-x-1 items-center mb-4">
                          <p class="text-xl text-wrap font-bold">{{$product->price}}</p> <span>CLP</span>
                       </div>

                       {{-- Cantidad del producto --}}
                       <div class="flex space-x-6 items-center mb-6">
                          <button class="btn btn-gris">
                            -
                          </button>

                          <span>1</span>

                          <button class="btn btn-gris">
                            +
                          </button>
                       </div>

                       {{-- Boton Agregar al Carrito --}}
                       <button class="btn btn-rojo w-full mb-6">
                        Agregar al Carrito
                       </button>

                       {{-- Icono - Texto entrega a domicilio --}}
                       <div class="flex items-center space-x-4 text-gray-700">
                        <i class="fa-solid fa-truck-fast text-2xl"></i>
                        <p> Entrega a domicilio </p>
                       </div>

                    </div>

                </div>
                
            </div>
      </x-container>
    
</x-app-layout>