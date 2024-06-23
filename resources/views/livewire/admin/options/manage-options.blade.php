<div>

   <section class="rounded-lg bg-white shadow-lg">

    <header class="border-b border-gray-300 px-6 py-2">

        <div class="flex justify-between ">
            <h1 class="text-lg font-semibold text-gray-700">
                Opciones
            </h1>
            <x-button wire:click="$set('newOption.openModal', true)">
                + Nuevo
            </x-button>
        </div>

    </header>

    <div class="p-6">
       
        <div class="space-y-6">
          @foreach ( $options as $option )

              <div class="p-6 rounded-lg border border-gray-300 relative"
                    wire:key="option-{{$option->id}}">

                    {{-- Opciones --}}
                    <div class="absolute -top-3 px-4 bg-white ">

                        <button class="mr-1" onclick="confirmDelete({{$option->id}}, 'option')">
                          <i class="fa-solid fa-trash-can text-red-400 hover:text-red-800"></i>
                        </button>

                        <span>
                            {{ $option->name }}
                        </span>

                    </div>
                    
                     {{--  Valores --}}
                    <div class="flex flex-wrap mb-4">

                        @foreach ($option->features as $feature)

                            @switch($option->type)
                                @case(1)
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 pr-0.5 pl-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                    {{$feature->description}}  

                                        <button class="bg-red-200 hover:bg-orange-700 rounded-sm" {{-- wire:click="deleteFeature({{$feature->id}})" --}}
                                                onclick="confirmDelete({{$feature->id}}, 'feature')"> 
                                            <i class="fa-solid fa-xmark text-black hover:text-white px-1.5 py-1.2"></i>
                                        </button>

                                    </span>
                                    @break

                                @case(2)
                                <div class="relative">
                                        {{-- Color --}}
                                        <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4" style="background-color: {{{$feature->value}}}"></span>

                                            <button class="bg-red-200 hover:bg-orange-700 rounded-full absolute z-10 left-3 -top-3 h-4 w-4 flex justify-center items-center"
                                                onclick="confirmDelete({{$feature->id}}, 'feature')"> 
                                                <i class="fa-solid fa-xmark text-black hover:text-white px-1 py-1 text-sm"></i>
                                            </button>
                                
                                </div>

                                    @break
                                @default
                                    
                            @endswitch
                            
                        @endforeach
                    </div>

                    <div class="">
                        @livewire('admin.options.add-new-feature', ['option'=> $option], key('add-new-feature-'. $option->id))
                    </div>

              </div>
              
          @endforeach
       </div>

    </div>

   </section>


   {{-- Creamos sesion para el MODAL de registro de opciones --}}
   <x-dialog-modal wire:model="newOption.openModal">
     <x-slot name="title" >
        <div class="bg-gray-100 w-100 p-2 rounded-md font-semibold">
            Registro Nueva Opción
        </div>
     </x-slot>

     <x-slot name="content">

       <x-validation-errors class="mb-4"/>

        <div class="grid grid-cols-2 gap-6 mb-4">

            <div>
               <x-label class="mb-1 font-semibold">
                 Nombre
               </x-label>

               <x-input
                wire:model.live="newOption.name" 
                class="w-full"
                placeholder="Agregar: Nueva Talla o Color"/>
            </div>

            <div>
                <x-label class="mb-1 font-semibold">
                    Tipo
                  </x-label>

                  <x-select
                  wire:model.live="newOption.type" 
                  class="w-full">
                    <option value="1">texto</option>
                    <option value="2">Color</option>
                  </x-select>

            </div>

        </div>

        <div class="flex items-center mb-4">
            <hr class="flex-1"><span class="bg-white px-3">Valores</span><hr class="flex-1">
        </div>

        <div class="mb-4 space-y-6">
            @foreach ($newOption->features as  $index => $feature)

                <div class="p-6 rounded-lg border border-gray-200 relative"

                {{-- Llave que identifica cada registro de valores --}}
                 wire:key="features-{{$index}}">
                    
                 <div class="absolute -top-3 px-4 bg-white">
                    <button wire:click="removeFeature({{$index}})">
                        <i class="fa-solid fa-xmark rounded-full bg-red-500 hover:bg-red-700 text-white hover:text-yellow-300 p-1 h-6 w-6 shadow-md flex items-center justify-center text-sm"></i>
                    </button>
                 </div>
                
                    <div class="grid grid-cols-2 gap-6">

                    
                            <div>
                                <x-label class="mb-1 font-semibold">
                                Valor
                                </x-label>
                                @switch($newOption->type)
                                    @case(1)
                                    <x-input 
                                            wire:model.live="newOption.features.{{ $index }}.value"
                                            class="w-full"
                                            placeholder="Ingrese el valor de la opción"/>
                                        
                                        @break
                                    @case(2)
                                        <div class="border border-gray-300 h-[42px] flex items-center rounded-md px-2 justify-between">
                                             
                                            
                                            <input type="color"
                                            wire:model.live="newOption.features.{{ $index }}.value">
                                            
                                            {{$newOption->features[$index]['value']?: 'Selecione un Color..'}}

                                        </div>
                                        
                                        @break
                                    @default
                                        
                                @endswitch

                            </div>

                            <div>
                                <x-label class="mb-1 font-semibold">
                                Descripción
                                </x-label>
                
                                <x-input 
                                wire:model.live="newOption.features.{{ $index }}.description"
                                class="w-full"
                                placeholder="Ingrese una descripción"/>
                            </div>
                        

                    </div>
                </div>

            @endforeach

        </div>

        <div class="flex justify-end">

            <button class="bg-green-500 text-green-50 hover:bg-green-800 hover:text-green-100 px-4 mx-4 rounded-md" wire:click="addOption">
               Registrar
            </button>

            <x-button
             wire:click="addFeature">
              + Agregar Valor            
            </x-button>

        </div>


     </x-slot>

     <x-slot name="footer">

     </x-slot>
   </x-dialog-modal>

     @push('js')

        <script>
            function confirmDelete(id, type){
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
                    
                        /*  Evaluamos lo que recibimos del boton */
                        switch (type) {
                            case 'feature':
                                 @this.call('deleteFeature', id); 
                            break;

                            case 'option':
                                 @this.call('deleteOption', id); 
                            break;
                        
                            default:
                                break;
                        }

                        
                        }
                });

        }
            
        </script>
         
     @endpush

</div>
