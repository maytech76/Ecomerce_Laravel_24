<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Family;
use App\Models\Category;
use Livewire\Attributes\Computed;

class Navigation extends Component
{
    
    public $families;
    public $family_id;
    public $loadedCategories; 
   

    public function mount()
    {
        $this->families = Family::all();    
        $this->family_id  = $this->families->first()->id;
        $this->loadedCategories = Category::with('subcategories')->get();
    }


    #[Computed()] 
    public function categories()
    {
       return Category::where('family_id', $this->family_id)
                      ->with('subcategories')
                      ->get();
    }

    #[Computed()] 
    public function familyName()
    {
        return Family::find($this->family_id)->name;
    }



    public function render()
    {
        return view('livewire.navigation', [
            'categories' => $this->categories(), // Pasamos las categorías a la vista
        ]);
    
    }
}
