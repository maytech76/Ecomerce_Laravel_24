<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Family;
use App\Models\Option;
use App\Models\Product;


class Filter extends Component
{
    use WithPagination;


    public $family_id;

    public $options;

    public function mount()
    {
        $this->options = Option::whereHas('products.subcategory.category', function($query){

            $query->where('family_id', $this->family_id);
 
            
         })->with([
             'features' => function($query){
                $query->whereHas('variants.product.subcategory.category', function($query){
                 $query->where('family_id', $this->family_id);
                });
             }
         ])
         ->get();
    }



    public function render()
    {
       /* muestra los productos que tenga relacion con una subcategoria esta 
                     con una categpria segun el id de familia suminisrado */
        $products = Product::whereHas('subcategory.category', function($query)
        {
           $query->where('family_id', $this->family_id);
        })
         ->paginate(12); /* mostrar el listado de producto en grupo de 12 resultados */

        return view('livewire.filter', compact('products'));/* Pasamos el resultado almacenado el la variable products a la vista */
    }
}
