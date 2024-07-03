<div x-data="{ open: false,}">
    <header class="bg-red-700">
        <x-container class="px-4 py-2">
            <div class="flex justify-between space-x-8 items-center">
                <button class="text-1xl md:text-2xl" x-on:click="open = true">
                    <i class="fas fa-bars text-white"></i>
                </button>

                {{-- Icon lines Cols --}}
                <h1 class="text-white">
                    <a href="/" class="inline-flex flex-col items-star">
                        <span class="text-xxl md:text-2xl leading-4 font-semibold">
                            Shopping-tech
                        </span>
                        <span class="text-xs">
                            Tienda Online
                        </span>
                    </a>
                </h1>

                {{-- Inpu Buscar --}}
                <div class="flex-1 hidden md:block">
                    <x-input class="w-full" placeholder="Buscar por producto, tienda o marcas"/>
                </div>

                <div class="space-x-8 flex items-center">

                    <x-dropdown>

                        <x-slot name="trigger">

                            @auth
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>

                                
                            @else
                                <button class="text-xxl md:text-2xl">
                                    <i class="fas fa-user text-white"></i>
                                </button>
                            @endauth
                            

                        </x-slot>

                        
                        <x-slot name="content">

                            @guest

                                <div class="px-2 py-2">

                                    <div class="flex justify-center">
                                        
                                        <a href="{{route('login')}}" class="btn btn-rojo">Iniciar Sesión</a>

                                    </div>

                                    <p class="text-sm text-center mt-2">
                                        ¿No tienes Cuenta? <a href="{{route('register')}}" class="text-red-500 hover:underline hover:text-red-800 hover:font-semibold">Registrate</a>
                                    </p>
                            

                                </div>

                            @else
                                
                                 <x-dropdown-link href="{{route('profile.show')}}">
                                    Mi perfil
                                 </x-dropdown-link>
                                 
                                 <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
    
                                    <x-dropdown-link href="{{ route('logout') }}"
                                             @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                                
                                
                            @endguest

                        </x-slot>

                    </x-dropdown>


                    <button class="text-xxl md:text-2xl">
                        <i class="fas fa-shopping-cart text-white"></i>
                    </button>
                </div>
            </div>

            {{-- Input Search Mobile --}}
            <div class="flex-1 md:hidden mt-4">
                <x-input class="w-full" placeholder="Buscar por producto..!"/>
            </div>

        </x-container>
    </header>

   {{--  Background opacity --}}
    <div x-show="open" x-on:click="open = false" style="display: none" class="fixed top-0 left-0 inset-0 bg-black bg-opacity-50 z-index-10"></div>

    {{-- Display Menues --}}
    <div x-show="open" style="display: none" class="fixed top-0 left-0 z-20">
        <div class="flex">
            <div class="w-screen md:w-80 h-screen bg-white">
                <div class="bg-red-700 px-4 py-3 text-white font-semibold">
                    <div class="flex justify-between items-center">
                        <span class="text-lg">
                            ¡Bienvenido!
                        </span>
                        <button x-on:click="open = false">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="h-[calc(100vh-52px)] overflow-auto">
                    <ul>
                        @foreach ($families as $family)
                            <li wire:mouseover="$set('family_id', {{ $family->id }})">
                                <a href="" class="flex justify-between px-4 py-4 text-gray-700 hover:text-red-600 hover:bg-gray-200 hover:font-semibold">
                                    {{ $family->name }}
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="w-80 xl:w-[57rem] pt-[52px] hidden md:block">
                <div class="bg-white h-[calc(100vh-52px)] overflow-auto px-6 py-8">

                    <div class="mb-8 flex justify-between items-center">
                        <p class="border-b-[1px] border-red-400 uppercase text-xl font-semibold">
                            {{$this->familyName}}
                        </p>

                        <a href="" class="btn btn-rojo">
                             Ver Todos..
                        </a>
                    </div>

                    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                        @foreach ($categories as $category)
                            <li>
                                <a href="" class="text-gray-700 hover:text-red-600 hover:font-semibold">
                                    {{ $category->name }}
                                </a>
                                <ul class="mt-4 space-y-1">
                                    @foreach ($category->subcategories as $subcategory)
                                        <li>
                                            <a href="" class="text-sm text-gray-500 hover:text-red-600">
                                                {{ $subcategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
