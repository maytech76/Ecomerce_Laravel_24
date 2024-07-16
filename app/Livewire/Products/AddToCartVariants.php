<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use Livewire\Attributes\Computed;
use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Component;


class AddToCartVariants extends Component
{
    public $product;
    
    public $qty = 1;

    /* Definimos la logica al seleccionar un Feature en la vista */
    public $selectedFeatures = [];

    public function mount()
    {
        foreach ($this->product->options as $option) {

            $features = collect($option->pivot->features);

            $this->selectedFeatures[$option->id] = $features->first()['id'];

        }
    }

    /* Definimos la propiedad computada */
    #[Computed()]
    public function variant()
    {
        /* Retorname las variantes selecionadas en la ficha del producto aplicando filtro */
        return $this->product->variants->filter(function($variant){
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);
        })->first();

    }


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
                'image'   => url('storage/' . $this->variant->image_path),
                'sku'     => $this->variant->sku,
                'features'=> Feature::whereIn('id', $this->selectedFeatures)
                                      ->pluck('description')
                                      ->toArray()
                ]
            ]);

        /* Aplicamos un chequeo, si el usuario se encuentra autentificado permite add to cart */
        if (auth()->check()){
            Cart::store(auth()->id());
        }

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

        return view('livewire.products.add-to-cart-variants');
    }
}
