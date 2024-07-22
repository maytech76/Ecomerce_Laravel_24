<?php

namespace App\Livewire;

use App\Http\Middleware\Authenticate;
use App\Livewire\Forms\CreateAddressForm;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;



class ShippingAddresses extends Component
{
    public $addresses;

    public $newAddress = true;

    public CreateAddressForm $createAddress;

    public function mount()
    {
        /* verificamos que el user_id sea igual al id del usuario autenticado */
        $this->addresses = Address::where('user_id', auth()->id())->get() ;

        /* recuperamo los valores de los campos del usuario autenticado */
        $this->createAddress->receiver_info =[

            'name' => auth()->user()->name,
            'last_name' =>auth()->user()->last_name,
            'document_type' =>auth()->user()->document_type,
            'document_number' =>auth()->user()->document_number,
            'phone' =>auth()->user()->phone,
        ];
    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
