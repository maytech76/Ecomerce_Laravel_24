<div>
   <section class="rounded-lg bg-white shadow-lg">

    <header class="border-b border-gray-300 px-6 py-2">
        <h1 class="text-lg font-semibold text-gray-700">
            Opciones
        </h1>

    </header>

    <div class="p-6">
       
        <div class="space-y-6">
          @foreach ( $options as $option )

              <div class="p-6 rounded-lg border border-gray-300 relative">

                <div class="absolute -top-3 px-4 bg-white ">
                    <span>
                        {{ $option->name }}
                    </span>

                </div>
                
               {{--  Valores --}}
                <div class="flex flex-wrap">

                   @foreach ($option->features as $feature)

                     @switch($option->type)
                         @case(1)
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                               {{$feature->description}}  
                            </span>
                             @break

                         @case(2)
                             {{-- Color --}}
                             <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4" style="background-color: {{{$feature->value}}}"></span>
                             @break
                         @default
                             
                     @endswitch
                       
                   @endforeach
                </div>

              </div>
              
          @endforeach
       </div>

    </div>

   </section>
</div>
