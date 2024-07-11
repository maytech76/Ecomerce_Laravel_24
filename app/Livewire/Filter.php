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

    public $subcategory_id;

    public $options;

    public $selected_features = [];

    public $orderBy = 1;

    public $search;

    public function mount()
    {
        /* Si en options tenemos dato de family_id almacenado, ejecuta esta funcion */
        $this->options = Option::verifyFamily($this->family_id)
        ->verifyCategory($this->category_id)
        ->verifySubcategory($this->subcategory_id)
        ->get()->toArray();

        
         
    }



    #[On('search')]
    public function search($search)
    {
       $this->search = $search;
    }



    public function render()
    {

       $products = Product::verifyFamily($this->family_id)

       ->verifyCategory($this->category_id)
       
       ->verifySubcategory($this->subcategory_id)

       ->customOrder($this->orderBy)

       ->selectFeatures($this->selected_features)

         ->when($this->search, function($query){
            $query->where('name', 'like', '%'.$this->search.'%');
         })



         ->paginate(12); /* mostrar el listado de producto en grupo de 12 resultados */

        return view('livewire.filter', compact('products'));/* Pasamos el resultado almacenado el la variable products a la vista */
    }
}
