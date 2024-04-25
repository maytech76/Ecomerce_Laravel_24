<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    public $subcategory; //recuperamo la informacion envidad desde la vista

    public $families;

    public $subcategoryEdit;

     /* Declaramos un metodo mount, que mostrara el listado de familias */
     public function mount($subcategory)
     {
 
         $this->families = Family::all(); /* Almacenamos todo el listado de registro */

         $this->subcategoryEdit = [
          'family_id'=> $subcategory->category->family_id,
          'category_id'=>$subcategory->category_id,
          'name'=>$subcategory->name

         ];
     }

     //Si se modifica el valor  Family_id del Arra SubCategoryEdit
     public function updatedSubcategoryEditFamilyId(){

        $this->subcategoryEdit['category_id']= ''; //Actualiza el valor de category_id a ''; 
    }

 
    #[Computed()] //definimos nuestra propiedad computada
    public function categories()
    {
        //Mostrar todas las categorias cuyo campo family_id coincidadn con lo que tenemos en el array subcategoryEdit
        return Category::where('family_id', $this->subcategoryEdit['family_id'])->get();
    }

    //Salvar en la DB la informacion recibida desde el formulario subcategory-edit
    public function save(){
     
        //Aplicamos Validaciones
        $this->validate([
            'subcategoryEdit.family_id' =>'required|exists:families,id',
            'subcategoryEdit.category_id' =>'required|exists:categories,id',
            'subcategoryEdit.name' =>'required'

        ]);

        $this->subcategory->update($this->subcategoryEdit);
       


        //Disparamos un evento que se cargara en nuestra plantilla admin.blade 
        $this->dispatch('swal', [
            'icon'=>'success',
            'title'=>'¡Excelente..!',
            'text'=>'Sub-Categoria Editada Correctamente..',
            'showConfirmButton'=> false,
            'timer'=> 1800
        ]);

        //Redirigimos a la vista Listado de SubCategorias
        return redirect()->route('admin.subcategories.edit', $this->subcategory->id); 



    }



    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }


}
