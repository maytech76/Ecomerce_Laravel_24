<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryCreate extends Component
{
    public $families; /* Definimos la propiedad families */


    public $subcategory = [

        'family_id'=>'',
       /*  'category'=>'', */
        'name' =>''
           
    ];

    /* Declaramos un metodo mount, que mostrara el listado de familias */
    public function mount()
    {

        $this->families = Family::all(); /* Almacenamos todo el listado de registro */
    }

    public function updatedSubcategoryFamilyId(){
        $this->subcategory['category_id']= '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subcategory['family_id'])->get();
    }

    
    //Salvar en la DB la informacion recibida desde el formulario subcategory-create
    public function save(){
        //Aplicamos Validaciones
        $this->validate([
            'subcategory.family_id' =>'required|exists:families,id',
            'subcategory.name' =>'required'

        ],[],[
            'subcategory.family_id'=>'Familia',
            'subcategory.category_id'=>'Categoria',
            'subcategory.name'=>'Nombre'
        ]);

        Subcategory::create($this->subcategory);
       

        session()->flash('swal',
                [
                    'icon'=>'success',
                    'title'=>'¡Excelente..!',
                    'text'=>'Sub-Categoria Creada Correctamente..',
                    'showConfirmButton'=> false,
                    'timer'=> 1800
                ]);

        //Redirigimos a la vista Listado de SubCategorias
        return redirect()->route('admin.subcategories.index');
    }


    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }
}
