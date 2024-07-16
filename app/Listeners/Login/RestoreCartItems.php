<?php

namespace App\Listeners\Login;

use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class RestoreCartItems
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        /* Restablecer Carrito de compra segun id del Usuario */
        Cart::instance('shopping')->restore($event->user->id);
    }
}
