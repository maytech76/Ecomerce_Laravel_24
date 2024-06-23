<div>
    <section class="rounded-lg border border-gray-200 bg-white shadow-lg">
        <header class="border-b border-gray-300 px-6 py-2">

            <div class="flex justify-between ">
                <h1 class="text-lg font-semibold text-gray-700">
                    Opciones del Producto
                </h1>
                <x-button wire:click="$set('openModal', true)">
                    + Nuevo
                </x-button>
            </div>
        </header>
    <section> 
        
      {{-- Creamos el componente modal para el registro de las variants --}}
     <x-dialog-modal wire:model="openModal">

         <x-slot name="title">
         
                <h3>Agregar nueva optión</h3>
           
        </x-slot>

        <x-slot name="content">
           {{--   Asignamos validaciones --}}
            <x-validation-errors class="mb-4"/>

            {{--  Select de options --}}
            <div class="mb-4">
                <x-label for="option" class="mb-1">Opción</x-label>

                    {{-- Enlazamos el select con la variable variants y el campo option_id del componente ProductVariants --}}
                    <x-select id="option" class="w-full" wire:model.live="variant.option_id">

                        <option value="" disabled>Seleccione una opción</option>

                        @foreach ($options as $option)
                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                        @endforeach

                    </x-select>
            </div>

        {{--   Lineas divisoras --}}
        <div class="flex items-center mb-6">
            <hr class="flex-1">
                <span class="mx-4">
                Valores
                </span>
            <hr class="flex-1">
        </div>
        {{-- Final Lineas divisoras --}}

             {{-- Listado de Valores Segun Options --}}
             <ul class="mb-4 space-y-4">
                
                @foreach ($variant['features'] as $index => $feature )

                    <li wire:key="variant-feature-{{$index}}"
                       class="relative border border-gray-300 rounded-md p-6">

                       {{-- icono delete --}}
                        <div class="absolute -top-3 bg-white px-4">
                            <button wire:click="removeFeature({{$index}})"> {{-- al click pasamos el index del feature al eliminar --}}
                                <i class="fa-solid fa-trash-can text-red-400 hover:text-red-800"></i>
                            </button>
                        </div>

                       {{--  listado de features(Valores) --}}
                       <div>

                         <x-label class="mb-1">
                            Valores
                         </x-label>

                         {{-- Enlazamos el select con el componente con su variant de valor con su indice --}}
                         <x-select class="w-full" 
                        wire:model="variant.features.{{$index}}.id"
                         wire:change="feature_change({{$index}})">

                            <option value=""disabled>
                                Selecciona un Valor
                            </option>

                            @foreach ($this->features as $feature )
 
                              <option value="{{$feature->id}}"> 
                                 {{$feature->description}}
                              </option>
                                
                            @endforeach
                         </x-select>


                       </div>

                    </li>
         
                @endforeach

            </ul>

            {{-- Botones de Accion --}}
            <div class="flex justify-end">

                 {{-- Modificamos la propiedad de openModal a Fase, logrando cerrar el modal --}}
                <x-danger-button class="hover:bg-red-800 mr-2"  wire:click="$set('openModal', false)">
                    Cancelar
                </x-danger-button>

                 {{-- Ejecutamos la funcion save, logrando asi el registro de un nuevo valor..segun opcion selecionada --}}
                <X-button class="btn-lime p-2 rounded-md mr-5 font-normal cursor-pointer uppercase" wire:click="save">
                    Guardar
                </X-button>

                <x-button wire:click="addFeature">
                   + Valor
                </x-button>

            </div>
              
        </x-slot>   
        <x-slot name="footer">

        </x-slot>

     </x-dialog-modal>
</div>