<div>
     <div class="grid grid-cols-1 lg:grid-cols-10 gap-6">

        {{-- Imagen-Nombre-precio-cantidad --}}
        <div class="lg:col-span-7">

           <div class="flex justify-between items-center my-2">
                <h1 class="text-lg flex">
                    Carrito de compras (<p class="font-bold text-red-600 mx-1">{{Cart::count()}}</p> Productos)
                </h1>

                <button class="font-semibold text-gray-500 hover:text-red-600 hover:underline">
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
                            <button class="bg-red-100 hover:bg-red-300 text-red-800 text-sm font-semibold rounded px-2">
                                <i class="fa-solid fa-xmark"></i>
                                Quitar
                            </button>
                         </div>

                         <p class="flex font-semibold mr-2">
                           {{$item->price}} 
                         </p>
                         <span>CLP</span>

                         <div class="ml-auto space-x-2">

                              <button class="btn btn-gris" x-on:click="qty = qty - 1">
                                 -
                              </button>
            
                              <span class="inline-block w-2 text-center">{{$item->qty}} </span>
            
                              <button class="btn btn-gris">
                                 +
                              </button>

                         </div>  
                      </li>

                      <hr>
                    @empty
                      <p class="text-center">No hay Productos en el Carrito</p>            
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
