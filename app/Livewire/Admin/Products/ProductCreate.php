<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;// activamos livewire para gestionar imagenes

    public $families;
    public $family_id = '';
    public $category_id = '';
    public $subcategory_id = '';
    public $image;
   

    public $product = [
        
        'sku'=>'',
        'name'=>'',
        'description'=>'',
        'images_path'=>'',
        'price'=>'',
        'subcategory_id'=>'',
    ];

    //listar todas la familias y montarla en la funcion mount y asi acceder al Modelo y sus Metodos
    public function mount(){
        $this->families = Family::all();
    }

    //En caso de fallar la validacion del formulario mostrar Alerta
    public function boot(){
       $this->withValidator(function($validator){

        if ($validator->fails()) {

            $this->dispatch('swal', [
              'icon'=> 'error',
              'title'=> '¡El formulario contiene Errores..!',
              'text' =>'Revisar Detalles',
              'showConfirmButton'=> false,
              'timer'=> 2000
            ]);
        }

       });
    }


    //Si actualizamos el campo Family_id reset valos de campos category_id - subcategory_id
    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->product['subcategory_id']='';
    }

    public function updatedCategoryId($value)
    {
        $this->product['subcategory_id']='';
    }

    #[Computed()]
    public function categories()
    {   //mostrar listado de categorias segun el valor family_id recibido
        return Category::where('family_id', $this->family_id)->get();
    }

    #[Computed()]
    public function subcategories()
    {   //mostrar listado de subcategorias segun el valor category_id recibido
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    

    //Metodo para insertar nuevo registro products
    public function store()
    {
        //Validamos la data recibida del formulario con sus respectivas reglas
        $this->validate([
            
                'image'=>'required|image|max:1024',
                'product.sku'=>'required|unique:products,sku',
                'product.name'=>'required|max:255',
                'product.description'=>'nullable',
                'product.price'=>'required|numeric|min:0',
                'product.subcategory_id'=>'required|exists:subcategories,id',
        ]);

        /*  Aplicamos un test para visualizar los campos que estamos enviando */
        /* dd($this->product); */

        /* Asignamos al campo images_path la informacion de la imagen y la ruta donde se almacenara */
        $this->product['images_path'] = $this->image->store('products');

        /*    dd($this->product); */

        /* Almacenamos el la variable $product  el registro del productos con data del formulario y la imagen */
        $product = Product::create($this->product);

        session()->flash('swal', [
            
                'icon'=>'success',
                'title'=>'¡Excelente..!',
                'text'=>'Producto Creado Correctamente..',
                'showConfirmButton'=> false,
                'timer'=> 1800

            ]);


        /* Direccionamos a la vista edit con los valores del producto */
        return redirect()->route('admin.products.edit', $product);
        

    }


    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
