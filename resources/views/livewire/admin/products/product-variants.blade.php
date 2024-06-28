<div>
    <div>
        <section class="rounded-lg border border-gray-200 bg-white shadow-lg mb-12">
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

            {{-- Sesion Listado de Features de Option --}}
            <div class="p-6">
                <div class="space-y-6">

                    @foreach ($product->options as $option)

                    <div wire:key="product-option-{{$option->id}}"
                        class=" relative p-6 rounded-lg border border-gray-300">

                        <div class="absolute -top-3 bg-white px-4">
                            <button onclick="confirmDeleteOption({{$option->id}})">
                            <i class="fa-solid fa-trash-can text-red-400 hover:text-red-800 "></i>
                            </button>

                            <span class="ml-3">
                                {{$option->name}}
                            </span>
                        </div>


                            {{----------  Valores --------------}}
                            <div class="flex flex-wrap">

                                @foreach ($option->pivot->features as $feature)

                                <div wire:key="option-{{$option->id}}-feature-{{$feature['id']}}">

                                    @switch($option->type)
                                            @case(1){{-- Texto --}}
                                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 pr-0.5 pl-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                                {{$feature['value']}}  

                                                    <button onclick="confirmDeleteFeature({{$option['id']}},{{$feature['id']}})" class="bg-red-200 hover:bg-orange-700 rounded-sm"> 
                                                        <i   class="fa-solid fa-xmark text-black hover:text-white px-1.5 py-1.2"></i>
                                                    </button>

                                                </span>
                                            @break

                                            @case(2)  {{-- Color --}}
                                            <div class="relative pt-2">
                                                
                                                    <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4" style="background-color: {{$feature['value']}}"></span>

                                                        <button class="bg-red-200 hover:bg-orange-700 rounded-full absolute z-10 left-3 top-1 h-4 w-4 flex justify-center items-center"
                                                            onclick="confirmDeleteFeature({{$option['id']}},{{$feature['id']}})"> 
                                                            <i class="fa-solid fa-xmark text-black hover:text-white px-1 py-1 text-sm"></i>
                                                        </button>
                                            
                                            </div>

                                                @break
                                        @default
                                            
                                    @endswitch

                                </div>
                                    
                                @endforeach
                            </div>{{-- End Features --}}

                            
                        </div>  
                        
                    @endforeach

                </div>
            </div>
        <section> 
    </div>

    <div>
        <section class="rounded-lg border border-gray-200 bg-white shadow-lg mb-12">
            <header class="border-b border-gray-300 px-6 py-2">

                <div class="flex justify-between ">
                    <h1 class="text-lg font-semibold text-gray-700">
                        Variantes
                    </h1>
                   
                </div>
            </header>

            <div class="py-6 -my-5">

               <ul class="divide-y">
                 @foreach ($product->variants as $item)

                   <li class="pl-4 py-4 flex items-center">
                     <img src="{{$item->image}}" class="w-10 h-10 object-cover object-center rounded-full">

                      <p class="divide-x">
                        @foreach ($item->features as $feature)

                         <span class="px-3">  {{$feature->description}} </span>
                            
                        @endforeach
                      </p>

                      <a href="{{route('admin.products.variants', [$product, $item])}}" class="ml-auto mr-4 btn btn-yellow-300 btn-amarillo"> Editar </a>

                   </li>
                     
                 @endforeach
               </ul>

            </div>

        </section>
    </div>

    


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


     @push('js')

     <script>

          

           function confirmDeleteFeature(option_id, feature_id){
                       Swal.fire({
                       title: "Seguro Eliminar Valores?",
                       text: "Este Proceso es Inrebersible!",
                       icon: "warning",
                       showCancelButton: true,
                       confirmButtonColor: "#3085d6",
                       cancelButtonColor: "#d33",
                       confirmButtonText: "Si, Eliminar!",
                       cancelButtonText: "Cancelar"
                   }).then((result) => {
                       if (result.isConfirmed) {
                       
                           @this.call('deleteFeature', option_id, feature_id);

                           
                           }
                   });

           }


           function confirmDeleteOption(option_id){
                       Swal.fire({
                       title: "Seguro Eliminar La Option",
                       text: "Este Proceso es Inrebersible!",
                       icon: "warning",
                       showCancelButton: true,
                       confirmButtonColor: "#3085d6",
                       cancelButtonColor: "#d33",
                       confirmButtonText: "Si, Eliminar!",
                       cancelButtonText: "Cancelar"
                   }).then((result) => {
                       if (result.isConfirmed) {
                       
                           @this.call('deleteOption', option_id);

                           
                           }
               });

           }   
       
           
     </script>  

   @endpush

</div>