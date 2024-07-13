<?php

namespace App\Livewire\Products;

use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;

    public $qty = 1;


    /* Metodo que se encargara de grabar items al carrito de compras */
    public function add_to_cart()
    {
        Cart::instance('shopping');

        
        Cart::add([
            'id'      => $this->product->id,
            'name'    => $this->product->name,
            'qty'     => $this->qty,
            'price'   => $this->product->price,
            'options'  => [
                'image'   => url('storage/' . $this->product->images_path),
                'sku'     => $this->product->sku,
                'features'=> [],
                ]
            ]);

            $this->dispatch('swal', [

                 'position' => 'top-end',
                 'icon'     => 'success',
                 'title'    => '¡Registro Efectuado con exito!',
                 'showConfirmButton' => false,
                 'timer'    => 1500
            ]);


        }
        
    public function render()
    {
       

        return view('livewire.products.add-to-cart');
    }
}
