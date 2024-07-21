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


   /* METODO PARA INCREMENTAR LA CANTIDAD POR ITEMS */
   public function increase($rowId)
   {
     /* Definimos la instancia con la que trabajamos */
     Cart::instance('shopping');

     /* Almacenamos el identificador rowId que viene del blade en item */
     $item = Cart::get($rowId);

    /*  Aplicaos el metodo update, al regitro selecionado y sumamo 1 */
     Cart::update($rowId, $item->qty +1);

     /* Aplicamos un chequeo, si el usuario se encuentra autentificado permite add to cart */
     if (auth()->check()){
      Cart::store(auth()->id());
     }

      /* Declaramos un evento que emitira el conteo de los items del carrito */
     $this->dispatch('cartUpdated', Cart::count());
      /* Este Evento sera escuchado por navigation.blade, donde se encuentra el icono cart */
   }

   /* METODO PARA DESCONTAR LA CANTIDAD POR ITEMS */
   public function decrease($rowId)
   {
      /* Definimos la instancia con la que trabajamos */
     Cart::instance('shopping');

     /* Almacenamos el identificador rowId que viene del blade en item */
     $item = Cart::get($rowId);

    if ($item->qty > 1 ) { /* Si el valor de qty es mayor a 1 restamos 1 */
      /*  Aplicaos el metodo update, al regitro selecionado y sumamo 1 */
       Cart::update($rowId, $item->qty - 1);
    }else{
       
       /* De lo contrario removemos del carrito el item selecionado */
       Cart::remove($rowId);
    }

     /* Aplicamos un chequeo, si el usuario se encuentra autentificado permite add to cart */
     if (auth()->check()){
      Cart::store(auth()->id());
     }

      /* Declaramos un evento que emitira el conteo de los items del carrito */
     $this->dispatch('cartUpdated', Cart::count());
      /* Este Evento sera escuchado por navigation.blade, donde se encuentra el icono cart */
   }

   /* METODO PARA REMOVER ITEM SELECIONADO DEL CARRITO */
   public function remove($rowId)
   {
      Cart::instance('shopping');
      Cart::remove($rowId);

      /* Aplicamos un chequeo, si el usuario se encuentra autentificado permite add to cart */
     if (auth()->check()){
      Cart::store(auth()->id());
     }

      /* Declaramos un evento que emitira el conteo de los items del carrito */
     $this->dispatch('cartUpdated', Cart::count());
      /* Este Evento sera escuchado por navigation.blade, donde se encuentra el icono cart */

      
   }


   /* METODO PARA VACIAR POR COMPLETO EL CARRITO */
   public function destroy()
   {
     Cart::instance('shopping');
     Cart::destroy();

     /* Aplicamos un chequeo, si el usuario se encuentra autentificado permite add to cart */
     if (auth()->check()){
      Cart::store(auth()->id());
     }

      /* Declaramos un evento que emitira el conteo de los items del carrito */
     $this->dispatch('cartUpdated', Cart::count());
      /* Este Evento sera escuchado por navigation.blade, donde se encuentra el icono cart */

   }


    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
