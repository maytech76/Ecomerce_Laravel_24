<div>
   <section class="bg-white rounded-lg shadow overflow-hidden">

    <header class="bg-gray-200 px-4 py-2">
          <h2 class="text-gray-700 text-center md:text-left">Direcciones de envio</h2>
    </header>

    <div class="p-4">

        @if ($newAddress)
 
                <x-validation-errors class="mb-6"/>  
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

                    {{-- Quien recibe --}}
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

                    {{-- Otra Persona --}}
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
                        <div><button wire:click="store" class="btn btn-verde w-full">Registrar</button></div>
                    </div>

                </div>


            
        @else

           @if ($editAddress->id)

           <x-validation-errors class="mb-6"/> 

           <div class="grid grid-cols-4 gap-4">

               {{-- Type --}}
               <div class="col-span-1">
               <x-select wire:model="editAddress.type">

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
               <x-input wire:model="editAddress.description" class="w-full" type="text" placeholder="Ingresa la dirección de recepción"/>  
               </div>

               {{-- District --}}
               <div class="col-span-2">
                   <x-input wire:model="editAddress.district" class="w-full" type="text" placeholder="Ingresa el distrito"/> 
               </div>

               {{-- reference --}}
               <div class="col-span-2">
                   <x-input wire:model="editAddress.reference" class="w-full" type="text" placeholder="Ingresa alguna referencia"/> 
               </div>

           </div>

           <hr class="my-4 text-gray-500">

           <div class=""
               x-data="
               {   {{-- elnlazamos la propiedad de Alpine con livewire --}}
                   receiver: @entangle('editAddress.receiver'),
                   receiver_info: @entangle('editAddress.receiver_info'),
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

               {{-- Quien recibe --}}
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

               {{-- Otra Persona --}}
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

                   <div><button wire:click="$set('editAddress.id', null)" class="btn btn-rosa w-full">Cancelar</button></div>

                   <div><button wire:click="update()" class="btn btn-amarillo w-full">Actualizar</button></div>
               </div>

           </div>
               
           @else
               

                @if ($addresses->count())

                        <ul class="grid grid-cols-1  md:grid-cols-3 gap-4">
                            @foreach ($addresses as $address )

                            {{-- Card for Address --}}
                            <li class="{{$address->default ? 'bg-gray-200 shadow-lg': 'bg-white'}} rounded-lg shadow"
                                        wire:key="addresses{{$address->id}}">

                                <div class="p-4 flex items-center">
                                    <div><i class="fa-solid fa-house text-xl text-red-600"></i></div>
                                    <div class="flex-1 mx-4 text-xs">
                                        <p class="text-red-700 font-bold">
                                            {{$address->type == 1 ? 'Domicilio :': 'Oficina :'}}
                                        </p>

                                        <p class="text-gray-700 font-light">
                                            {{$address->district}}
                                        </p>

                                        <p class="text-gray-500 font-light">
                                            {{$address->description}}
                                        </p>

                                        <p class="text-gray-700 font-semibold">
                                            {{$address->receiver_info['name']}}
                                            <span>{{$address->receiver_info['last_name']}}</span>
                                        </p>
                                    </div>
                                    <div class="text-xs text-gray-600 flex flex-col gap-2">

                                        <button wire:click="setDefaultAdrress({{$address->id}})"><i class="fa-solid fa-star {{$address->default ? 'text-yellow-300' : 'text-gray-600'}}"></i></button>
                                    
                                        <button wire:click="edit({{$address->id}})"><i class="fa-solid fa-pencil text-gray-500"></i></button>
                                        
                                        <button wire:click="deleteAddress({{$address->id}})"><i class="fa-solid fa-trash-can text-red-500"></i></button>
                                    </div>
                                </div>

                            </li>
                            {{-- End Card for Address --}}
                                
                            @endforeach
                        </ul>
                    
                @else
                        <p>No se ha encontrado Direcciones</p>
                @endif

                <button class="bg-gradient-to-r from-gray-400 to-gray-700 text-white font-bold hover:bg-gradient-to-l hover:from-gray-400 hover:to-gray-700 py-2 px-4 rounded w-full my-4"
                        wire:click="$set('newAddress', true)">
                        Agregar <i class="fa-solid fa-plus ml-2"></i>
                </button>
            @endif
            
        @endif
    </div>

   </section>
</div>
