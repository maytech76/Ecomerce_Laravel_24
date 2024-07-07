<x-admin-layout :breadcrumbs="[

     [
      'name'=>'Dashboard',
      'route'=> route('admin.dashboard'),
      
    ],

    [
      'name'=>'Productos',
      
     ]
     
   ]">

   
    {{-- Boton nuevo Registro --}}
    <x-slot name="action">
    
        <a class="btn btn-azul" href="{{route('admin.products.create')}}">
            + Nuevo
        </a>
        
    </x-slot>

     {{--  Tabla del listado de Categorias --}}
  @if ($products->count())

  
  {{-- Tablas de Registros --}}
<div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="px-6 py-3">
                      ID
                  </th>

                  <th scope="col" class="px-6 py-3">
                      Sku
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Nombre
                  </th>
                  
                  <th scope="col" class="px-6 py-3">
                        Imagen     
                  </th>

                  <th scope="col" class="px-6 py-3">
                      Precio
                  </th>

                  <th scope="col" class="px-6 py-3">
                      Acción
                  </th>
              </tr>
          </thead>
          <tbody>

              @foreach ($products as $product )
                  
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                          {{$product->id}}
                      </th>

                      <td class="px-6 py-4">
                          {{$product->sku}}
                      </td>

                      <td class="px-6 py-4">
                          {{$product->name}}
                      </td>

                      <td class="px-6 py-4 w-10 h-10">
                         <img class="rounded-md shadow-md" src="https://ecomerce.test/storage/{{$product->images_path}}">
                      </td>

                      <td class="px-6 py-4">
                          {{$product->price}}
                      </td>
                      
                      <td class="px-6 py-4">
                          <a href="{{route('admin.products.edit', $product)}}">
                          Editar
                          </a>
                      </td>
                      
                  </tr>
              @endforeach
              
          </tbody>
      </table>
</div>

    @else

    {{--  Alerta Notificacion de tabla sin registros --}}
    <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Informacion :</span>
        <div>
        <span class="font-medium">Notificación!</span> Aun no hay registros para mostrar.
        </div>
    </div>


    @endif

{{-- Paginacion --}}
<div class="mt-4">
{{$products->links()}}
</div>
</x-admin-layout>