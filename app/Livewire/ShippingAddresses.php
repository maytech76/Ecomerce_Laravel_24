<?php

namespace App\Livewire;

use App\Http\Middleware\Authenticate;
use App\Livewire\Forms\CreateAddressForm;
use App\Models\Address;
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
    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
