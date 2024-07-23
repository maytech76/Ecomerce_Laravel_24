<x-app-layout>
    <x-container>
        <div class="mx-3 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="col-span-2 mt-12">
               {{-- LLamamo al componente livewire --}}
               @livewire('shipping-addresses')

            </div>

            <div class="col-span-1">

                <div class="bg-white rounded-lg shadow overflow-hidden">

                </div>
              
            </div>

        </div>
    </x-container>
</x-app-layout>