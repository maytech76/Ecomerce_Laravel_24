<?php

namespace App\Livewire;

use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShoppingCart extends Component
{

   public function mount()
   { /* Definimos la instancia con la que trabajamos */
     Cart::instance('shopping');
   }


    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
