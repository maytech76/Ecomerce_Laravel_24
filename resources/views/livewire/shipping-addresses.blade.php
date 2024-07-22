<div>
   <section class="bg-white rounded-lg shadow overflow-hidden">

    <header class="bg-gray-200 px-4 py-2">
          <h2 class="text-gray-700">Direcciones de envio</h2>
    </header>

    <div class="p-4 text-center justify-center">
        @if ($newAddress)

         
        <div class="grid grid-cols-4 gap-4">

            {{-- Type --}}
            <div class="col-span-1">
               <x-select wire:model="createAddress.type">

                  <option value="">
                    Tipo de Dirección
                  </option>

                  <option value="1">
                    Domicilio
                  </option>

                  <option value="2">
                    Oficina
                  </option>

               </x-select>
            </div>

            {{-- Description --}}
            <div class="col-span-3">
               <x-input wire:model="createAddress.description" class="w-full" type="text" placeholder="Ingresa la dirección de recepción"/>  
            </div>

            {{-- District --}}
            <div class="col-span-2">
                <x-input wire:model="createAddress.district" class="w-full" type="text" placeholder="Ingresa el distrito"/> 
            </div>

            {{-- reference --}}
            <div class="col-span-2">
                <x-input wire:model="createAddress.reference" class="w-full" type="text" placeholder="Ingresa alguna referencia"/> 
            </div>

        </div>

        <hr class="my-4 text-gray-500">

        <div class=""
            x-data="
            {   {{-- elnlazamos la propiedad de Alpine con livewire --}}
                   receiver: @entangle('createAddress.receiver'),
                   receiver_info: @entangle('createAddress.receiver_info'),
                }" x-init="
                   $watch('receiver', value => {
                    if(value == 1){

                        receiver_info.name = '{{auth()->user()->name}}';
                        receiver_info.last_name = '{{auth()->user()->last_name}}';
                        receiver_info.document_type = '{{auth()->user()->document_type}}';
                        receiver_info.document_number = '{{auth()->user()->document_number}}';
                        receiver_info.phone = '{{auth()->user()->phone}}';

                    }else{

                        receiver_info.name = '';
                        receiver_info.last_name = '';
                        receiver_info.document_number = '';
                        receiver_info.phone = '';

                    }
                   })
                ">
            <p class="font-semibold mb-2">
               ¿Quien Recibirá el Pedido?
            </p>

            <div class="flex gap-8 items-center mb-4">

                <label class="space-x-4">
                    <input x-model="receiver"  type="radio" value="1" name="colored-radio" 
                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-1"> 
                    El Comprador
                </label>

                <label class="space-x-4">
                    <input x-model="receiver"  type="radio" value="2" name="colored-radio" 
                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-1">
                     Otra Persona
                </label>

            </div>

            <div class="grid grid-cols-2 gap-2">

                <div class=""><x-input x-bind:disabled="receiver == 1" x-model="receiver_info.name" class="w-full" placeholder="Nombre"></x-input></div>
                <div class=""><x-input x-bind:disabled="receiver == 1" x-model="receiver_info.last_name" class="w-full" placeholder="Apellidos"></x-input></div>  
                
                <div class="flex space-x-2 mb-2">
                    <x-select>
                        @foreach (\App\Enums\TypeOfDocuments::cases() as $item)

                        <option value="{{$item->value}}">{{$item->name}} </option>
                            
                        @endforeach
                    </x-select>
                    <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.document_number" class="w-full" placeholder="Numero de Documento"/>   
                </div>              
                <div> <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.phone" class="w-full" placeholder="Ingresar Telefono"/> </div>
                <div><button wire:click="$set('newAddress', false)" class="btn btn-rosa w-full">Cancelar</button></div>
                <div><button class="btn btn-verde w-full">Registrar</button></div>
            </div>

        </div>


            
        @else

            @if ($addresses->count())
                
            @else
                <p>No se ha encontrado Direcciones</p>
            @endif

            <button class="bg-gradient-to-r from-gray-400 to-gray-700 text-white font-bold hover:bg-gradient-to-l hover:from-gray-400 hover:to-gray-700 py-2 px-4 rounded w-full my-4"
             wire:click="$set('newAddress', true)">
            Agregar <i class="fa-solid fa-plus ml-2"></i>
            </button>
            
        @endif
    </div>

   </section>
</div>
