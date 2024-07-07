<div class="bg-white py-12">

    <x-container class="px-4 flex">
        <aside class="w-52 flex-shrink-0 mr-8">
             <ul class="space-y-6">
                 @foreach ( $options as $option )

                     <li>
                       <button class="px-4 py-2 bg-slate-300 w-full text-left text-gray-800 flex justify-between items-center">
                          {{ $option->name }}

                           <i class="fa-solid fa-angle-down"></i>
                       </button>

                        <ul class="mt-2 space-y-2">
                            @foreach ( $option->features as $feature )
                                <li>
                                    <label class="inline-flex items-center">

                                        <x-checkbox class="mr-2"/> 

                                        {{ $feature->description }}

                                    </label>
                                </li>
                            @endforeach
                        </ul>
                     </li>
                     
                 @endforeach
             </ul>
        </aside>

        <div class="">

        </div>
    </x-container>
   
</div>
