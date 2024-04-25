<div class="">
    <form wire:submit="save">

        <div class="card">
            <x-validation-errors class="mb-4"/>

            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Familias:
                </x-label>

                
                <x-select name="family_id" class="w-full" wire:model.live="subcategoryEdit.family_id">
                    
                    <option value="" disabled>Seleccione una Familia</option>

                    @foreach ( $families as $family )
                    <option value="{{$family->id}}"
                        @selected(old('family_id') == $family->id)>
                        {{$family->name}}
                        
                    </option>
                    @endforeach
                </x-select>

            </div> 

            <br>

    
            <div class="mb-4">
                <x-label class="mb-2 font-semibold">
                    Categorias :
                </x-label>
                <x-select name="category_id" class="w-full" wire:model="subcategoryEdit.category_id">
                    <option value="" disabled>Seleccione una Categoria</option>
                        @foreach ($this->categories as $category )
                            <option value="{{$category->id}}"
                                @selected(old('category_id') == $category->id)>
                                {{$category->name}}
                            </option>
                        @endforeach
                </x-select>
            </div>


                <div class="">
                    <x-label class="mb-2 font-semibold">
                        Nombre :
                    </x-label>
                    <x-input class="w-full" placeholder="ingresar nombre de la Categoria.." wire:model="subcategoryEdit.name"/>
                </div>

                <div class="flex justify-end">

                    <x-danger-button class="mt-2" onclick="confirmDelete()">
                        Eliminar
                      </x-danger-button>
                    
                    <x-button type="submit" class="btn btn-verde mt-2 ml-2 bg-yellow-400 text-black hover:bg-yellow-600 hover:text-gray-100">
                        Actualizar
                    </x-button>
                    
                </div>
        </div>

    </form>
    {{-- @dump($this->categories) --}}
    <form action="{{route('admin.subcategories.destroy', $subcategory)}}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
     </form>
     
     {{-- //Enviar Funciones y metodos de javascrip a plantilla admin --}}
     @push('js')
     
        <script>
          function confirmDelete(){
     
             /*  */
     
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
                
     
                 document.getElementById('delete-form').submit();
                }
             });
     
          }
        </script>
         
     @endpush
  </div>

   