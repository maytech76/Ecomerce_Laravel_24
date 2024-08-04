<x-app-layout>
    <x-container>
        <div class="mx-3 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="col-span-2 mt-12">
               {{-- LLamamo al componente livewire --}}
               @livewire('shipping-addresses')

            </div>

            <div class="col-span-1 mt-12">

               {{--  Titulo de Encabezado --}}
                <div class="bg-white rounded-t shadow overflow-hidden">
                    <div class="bg-red-100 text-gray-700 p-2 flex justify-between items-center">
                            <p class="font-semibold">
                            <span class="mr-2"> Resumen de Compra </span> ( {{Cart::instance('shopping')->count()}} )
                            </p>
                             <a class="ml-4" href="{{route('cart.index')}}"><i class="fa-solid fa-cart-shopping text-sm"></i></a>
                    </div>
                </div>

                {{-- Dealles de productos en carrito de compras --}}
                <div class="p-4 text-gray-600 shadow rounded-b-md mb-4">
                     <ul>
                        @foreach (Cart::content() as $item )
                            <li class="flex items-center space-x-4 py-4">
                                    <figure class="shrink-0">
                                        <img class="h-12 aspect-square rounded-md" src="{{$item->options->image}}" alt="">
                                    </figure>
                                    <div class="flex-1">
                                        <p class="truncate text-sm">
                                            {{$item->name}}
                                        </p>
                                        <p>
                                            {{$item->price}} <span> CLP</span>
                                        </p>
                                    </div>
                                    <div class="">
                                        {{$item->qty}}
                                    </div>
                            </li>                        
                        @endforeach
                     </ul>
                     <hr class="my-4">

                     <div class="flex justify-between">
                            <p class="text-lg">
                                Total a Pagar:
                            </p>

                            <p class="font-extrabold text-gray-900">
                                {{Cart::subtotal()}}
                                <span class="ml-2 text-gray-700">CLP</span>
                            </p>
                     </div>
                </div>

                {{-- Boton Forma de pago --}}
                <a href="{{route('checkout.index')}}" class="font-light hover:font-bold hover:gb-red-800 btn btn-red-gradiente block w-full text-center">
                    Siguiente
                </a>

                <div class="w-full flex justify-center items-center py-3 bg-gray-100 hover:bg-white rounded-lg shadow-md">
                    Procesar pago de la compra
                </div>
                
                <hr>
                <div x-data="{open: false}">{{-- Web Pay --}}
                    <button class=" w-full flex justify-center items-center py-3 bg-gray-100 hover:bg-white rounded-lg shadow">
                        <img class="h-8" src="https://cuvishome.cl/wp-content/uploads/2023/01/webpay_logo.png" alt="">
                    </button>
                </div>
              
            </div>

            

        </div>
    </x-container>
</x-app-layout>