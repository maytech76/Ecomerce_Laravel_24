<x-container>
    <div class="card mt-4">
        <div class="grid md:grid-cols-2 gap-6">

            {{-- columna Izquierda --}}
            <div class="col-span-1">

                <figure>
                    <img src="{{ asset('storage/' . $product->images_path) }}" class="aspect-[1/1] w-full object-cover object-center rounded-lg shadow-md">
                </figure>
                
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
               <div class="flex space-x-6 items-center mb-6" x-data = "{ qty: @entangle('qty')}"  >

                  <button class="btn btn-gris" x-on:click="qty = qty - 1" x-bind:disabled="qty == 1">
                    -
                  </button>

                  <span x-text="qty" class="inline-block w-2 text-center"></span>

                  <button class="btn btn-gris" x-on:click="qty = qty + 1">
                    +
                  </button>
               </div>

               {{-- Boton Agregar al Carrito --}}
               <button class="btn btn-rojo w-full mb-6" wire:click="add_to_cart">{{-- al click, ejecuta el evento add_to_cart --}}
                Agregar al Carrito
               </button>

               <div class="text-sm text-gray-600 mb-4">
                {{$product->description}}
               </div>

               {{-- Icono - Texto entrega a domicilio --}}
               <div class="flex items-center space-x-4 text-gray-700">
                <i class="fa-solid fa-truck-fast text-2xl"></i>
                <p> Entrega a domicilio </p>
               </div>

            </div>

        </div>
        
    </div>
</x-container>
