<?php

namespace App\Livewire\Admin\Products;

    use Livewire\Component;
    use App\Models\Category;
    use App\Models\Family;
    use App\Models\Subcategory;
    use App\Models\Product;
    use Livewire\Attributes\Computed;
    use Livewire\Attributes\On;
    use Illuminate\Support\Facades\Storage;
    use Livewire\WithFileUploads;
    

class ProductEdit extends Component
{
    use WithFileUploads;// activamos livewire para gestionar imagenes

    public $product;
    public $productEdit;
   
    public $families;
    public $family_id='';
    public $category_id = '';
    public $image;

    public function mount( Product $product)
    {
        $this->productEdit = $product->only('sku', 'name', 'images_path', 'description', 'price', 'stock', 'subcategory_id');

        $this->families = Family::all();

        $this->category_id = $product->subcategory->category->id;
        $this->family_id = $product->subcategory->category->family->id;
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
        $this->productEdit['subcategory_id']='';
    }

     //Si actualizamos el campo category_id reset valores del campo subcategory_id = ''
    public function updatedCategoryId($value)
    {
        $this->productEdit['subcategory_id']='';
    }

    /* Asignamos un evento updateProduct, el cual actualizara la clase  de producto */
    #[On('variant-generate')]
    public function updateProduct()
    {
        $this->product = $this->product->fresh();
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
             
                 'image'=>'nullable|image|max:1024',
                 'productEdit.sku'=>'required|unique:products,sku,'. $this->product->id,
                 'productEdit.name'=>'required|max:255',
                 'productEdit.description'=>'nullable',
                 'productEdit.price'=>'required|numeric|min:0',
                 'productEdit.stock'=>'required|numeric|min:0',
                 'productEdit.subcategory_id'=>'required|exists:subcategories,id',
         ]);
 
         /* Verificamos si se ha escojido una nueva imagen*/
         if ($this->image) {
            //Si exite una nueva imagen eliminamos la antigua recibida
            Storage::delete($this->productEdit['images_path']);

            /* Asignamos al campo images_path la informacion de la imagen y la ruta donde se almacenara */
            $this->productEdit['images_path'] = $this->image->store('products');
           
         }
 
         /* Almacenamos el la variable $product  el registro del productos con data del formulario y la imagen */
         $this->product->update($this->productEdit);

 
         session()->flash('swal', [
            
            'icon'=>'success',
            'title'=>'¡Excelente..!',
            'text'=>'Producto Editado Correctamente..',
            'showConfirmButton'=> false,
            'timer'=> 1800

        ]);


        /* Direccionamos a la vista edit con los valores del producto */
        return redirect()->route('admin.products.edit', $this->product);
    
 
     }



    public function render()
    {
        return view('livewire.admin.products.product-edit');
        
    }
}
