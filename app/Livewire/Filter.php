<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Family;
use App\Models\Category;
use App\Models\Option;
use App\Models\Product;
use Livewire\Attributes\On;


class Filter extends Component
{
    use WithPagination;

    public $family_id;

    public $category_id;

    public $options;

    public $selected_features = [];

    public $orderBy = 1;

    public $search;

    public function mount()
    {
            /* Si en options tenemos dato de family_id almacenado, ejecuta esta funcion */
        $this->options = Option::when($this->family_id, function($query){

            $query->whereHas('products.subcategory.category', function($query){

                $query->where('family_id', $this->family_id);
     
                
             })->with([
                 'features' => function($query){
                    $query->whereHas('variants.product.subcategory.category', function($query){
                        $query->where('family_id', $this->family_id);
                    });
                 }
            ]);
        })
        ->when($this->category_id, function($query){
            $query->whereHas('products.subcategory', function($query){
                $query->where('category_id', $this->category_id);
            })->with([
                'features' => function($query){
                    $query->whereHas('variants.product.subcategory', function($query){
                        $query->where('category_id', $this->category_id);
                    });
                }
            ]);
        })
        ->get()->toArray();

        
         
    }



    #[On('search')]
    public function search($search)
    {
       $this->search = $search;
    }



    public function render()
    {

       $products = Product::when($this->family_id, function($query){

          /* muestra los productos que tenga relacion con una subcategoria esta 
                     con una categpria segun el id de familia suminisrado */
          $query->whereHas('subcategory.category', function($query)
          {
             $query->where('family_id', $this->family_id);
          });
       })
       ->when($this->category_id, function($query){
          $query->whereHas('subcategory', function($query){
            $query->where('category_id', $this->category_id);
          });
       })

        ->when($this->orderBy == 1, function($query){
            $query->orderBy('created_at', 'desc');
        })
        ->when($this->orderBy == 2, function($query){
            $query->orderBy('price', 'desc');
        })
        ->when($this->orderBy == 3, function($query){
            $query->orderBy('price', 'asc');
        })




         ->when($this->selected_features, function($query){ /* Ejecuta esta consulta si existe un feature selecionad */
            /* consulta las relaciones entre variants y features que contengan el feature_id selecionado */
            $query->whereHas('variants.features', function ($query){ 
                $query->whereIn('features.id', $this->selected_features);
            });
         })
         ->when($this->search, function($query){
            $query->where('name', 'like', '%'.$this->search.'%');
         })



         ->paginate(12); /* mostrar el listado de producto en grupo de 12 resultados */

        return view('livewire.filter', compact('products'));/* Pasamos el resultado almacenado el la variable products a la vista */
    }
}
