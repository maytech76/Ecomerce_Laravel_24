<div>
     <div class="grid grid-cols-1 lg:grid-cols-10 gap-6">

        {{-- Imagen-Nombre-precio-cantidad --}}
        <div class="lg:col-span-7">

           <div class="flex justify-between items-center my-2">
                <h1 class="text-lg flex">
                    Carrito de compras (<p class="font-bold text-red-600 mx-1">{{Cart::count()}}</p> Productos)
                </h1>

                <button class="font-semibold text-gray-500 hover:text-red-600 hover:underline"
                    wire:click="destroy()">
                    Vaciar Carrito
                </button>
           </div>

           <div class="card">
              <ul class="space-y-4">
                  {{--  Recuperamos el contenido del carrito de compras --}}
                   @forelse (Cart::content() as $item )

                      <li class="lg:flex items-center">
                         <img class="w-full lg:w-36 aspect-[1/1] mr-4 object-cover object-center rounded-lg 
                         shadow-md  hover:shadow-lg transform transition-transform duration-300 hover:scale-110 mb-2" 
                         src="{{$item->options->image}}" alt="">

                         <div class="w-80">
                            <p class="text-sm">
                                <a href="{{route('products.show', $item->id)}}">
                                    {{$item->name}}
                                </a> 
                            </p>

                            <button class="bg-red-100 hover:bg-red-300 text-red-800 text-sm font-semibold rounded px-2"
                                wire:click="remove('{{$item->rowId}}')">
                                <i class="fa-solid fa-xmark"></i>
                                Quitar
                            </button>
                         </div>

                        {{--  Precio x item --}}
                         <p class="flex font-semibold mr-2">
                           {{$item->price}} 
                         </p>
                         <span>CLP</span>

                          {{-- Cantidades --}}
                         <div class="ml-auto space-x-2">

                              <button class="btn btn-gris" wire:click="decrease('{{$item->rowId}}')">
                                 -
                              </button>
            
                              <span class="inline-block w-2 text-center">{{$item->qty}} </span>
            
                              <button class="btn btn-gris" wire:click="increase('{{$item->rowId}}')">
                                 +
                              </button>

                         </div>  
                      </li>

                      <hr>
                    @empty
                      <p class="text-center">No hay Productos en el Carrito</p>
                      <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                          <span class="font-medium">No se puede Proceder, </span> Debes Agregar Productos al carrito para poder continuar..!
                        </div>
                      </div>            
                   @endforelse
              </ul>
           </div>

        </div>


        <div class="mt-12 lg:col-span-3">
           <div class="card">
               <div class="flex justify-between font-semibold mb-4">
                  <p>
                     Total:
                  </p>
                  <p class="">
                     {{Cart::subtotal()}}
                     <span class="font-light text-gray-600"> CLP</span>
                  </p>
               </div>
               <a href="" class="btn btn-rojo block w-full text-center">Continuar Compra</a>
           </div>
        </div>

     </div>
</div>
