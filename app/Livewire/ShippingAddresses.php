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

    /* Metodo store que sera activado por el boton registrar del formulario shipping-address */
    public function store()
    {
        $this->createAddress->save();

        /* verificamos que el user_id sea igual al id del usuario autenticado y refrescamos */
        $this->addresses = Address::where('user_id', auth()->id())->get() ;

       /*  Cerramos el formulario */
       $this->newAddress = false;

        
    }

    /* Metodo setDefaultAdrress activara el cambio de direccion por defecto */
    public function setDefaultAdrress($id)
    {
       /*  establece el valor del campo default en true si el ID de la dirección actual 
        coincide con el ID proporcionado ($id), y en false si no */

        $this->addresses->each(function($address) use ($id){
            $address->update(['default' =>$address->id == $id]);
        });
    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
