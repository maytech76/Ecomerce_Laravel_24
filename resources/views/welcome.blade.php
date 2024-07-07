<x-app-layout>

    @push('css')

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>     

    @endpush

    <!-- Slider main container -->
    <div class="swiper mb-12">

        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->

             @foreach ($covers as $cover ) 

              <div class="swiper-slide">
                 <img src="{{$cover->image}}" 
                 class="w-full aspect[3/1] objetc-cover object-center">
              </div>
                
            @endforeach 
            
    
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    
        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>
  


    {{-- Sesion de Ultimos Productos --}}
    <x-container class="">
            <h1 class="text-2xl font-bold text-gray-600 mb-4">
                Ultimos Productos
            </h1>     
            {{-- Grids de productos segun Dimensiones de pantalla --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-4">

                @foreach ( $lastProducts as  $product)
                
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
    </x-container>

    @push('js')

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script>
            const swiper = new Swiper('.swiper', {
                    // Optional parameters  
                    loop: true,

                    // Autoplay settings
                    autoplay: {
                        delay: 4000, // 5 seconds
                        disableOnInteraction: false,
                    },
                    
                    // If we need pagination
                    pagination: {
                        el: '.swiper-pagination',
                    },

                    // Navigation arrows
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },

                    // And if we need scrollbar
                    scrollbar: {
                        el: '.swiper-scrollbar',
                    },
            });

        </script>

    @endpush

</x-app-layout>