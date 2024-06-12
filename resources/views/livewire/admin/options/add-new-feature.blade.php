<div>
    <form wire:submit="addFeature" class="flex space-x-4">

        {{-- Options --}}
        <div class="flex-1">
          
               <x-label class="mb-1 font-semibold">
                Valor
                </x-label>

                @switch($option->type)
                    @case(1)
                    <x-input 
                            wire:model.live="newFeature.value"
                            class="w-full"
                            placeholder="Ingrese el valor de la opción"/>
                        
                        @break
                    @case(2)
                        <div class="border border-gray-300 h-[42px] flex items-center rounded-md px-2 justify-between">
                             
                            
                            <input type="color"
                            wire:model.live="newFeature.value">
                            
                            {{$newFeature['value']?: 'Selecione un Color..'}}

                        </div>
                        
                        @break
                    @default
                        
                @endswitch

        </div>


         {{-- Feature --}}
        <div class="flex-1">

                <x-label class="mb-1 font-semibold">
                   Descripción
                </x-label>

                <x-input 
                    wire:model.live="newFeature.description"
                    class="w-full"
                    placeholder="Ingrese una descripción"
                />

        </div>

         {{--  Boton --}}
        <div class="pt-7">
            <x-button
                >
                + | Agregar           
            </x-button>
        </div>

    </form>
</div>
