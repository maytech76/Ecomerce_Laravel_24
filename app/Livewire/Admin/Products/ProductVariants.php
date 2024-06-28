<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Option;
use App\Models\Feature;
use App\Models\Product;
use Livewire\Attributes\Computed;
use App\Models\Variant; 

class ProductVariants extends Component

{

  public $openModal = false;

    public $options;

    /* Como recibiremos un parametro, declaramos una variable con el mismo nombre */
    public $product;


    public $variant =[
  
        'option_id'=>'',
        'features'=> [
           
           [
            'id' =>'',
            'value'=>'',
            'description' => ''
           ]
        ]
    
    ];

     /*  Inicalizamos la Variable option-relacionada con el Model Option y aplicando el metodo All */
   public function mount()
   {
     $this->options = Option::all();
   }

   /* Reseteamos los inpunt de Featura, vez el select option del Modal cambie de valos  */
   public function updatedVariantOptionId()
   {
     $this->variant['features']= [
        
        [
            'id' =>'',
            'value'=>'',
            'description' => ''
        ]
     ];
   }

     /*  Declaramos un nuevo metodos para arquirir todos los features segun option selecionada, en conjunto con una Propieda computada */
    #[Computed()]
    public function features()
    {
      /* retorna todos aqueyo fearure que contenga la option_id igual a la selecionada */
      return Feature::where('option_id', $this->variant['option_id'])->get();
    }


   /*  Agregamos un nuevo Input donde registraremos un nuevo valor (Modal New feature) */
    public function addFeature()
    {
      $this->variant['features'][]=[
              'id' =>'',
              'value'=>'',
              'description' => ''
      ];
    }

    public function feature_change($index)
    {
      $feature = Feature::find($this->variant['features'][$index]['id']);
 
     /*  Validamos si el feature recibido existe en ls DB */
     if($feature){
         $this->variant['features'][$index]['value']= $feature->value;
         $this->variant['features'][$index]['description']= $feature->description;
     }
    }

    public function save()
    {

      /* Antes de almacenar nuevo registro Validamos */
       $this->validate([
        'variant.option_id' => 'required',
        'variant.features.*.id' => 'required',
        'variant.features.*.value' => 'required',
        'variant.features.*.description' => 'required'
       ]);

       /*  Por medio de la relacion que establecimos entre product y options accedemos los valores
        del features(id, value, description) y efectuamos el registro en la tabla productOption */
        $this->product->options()->attach($this->variant['option_id'], [
          'features'=> $this->variant['features']
        ]);

        /* refrescamos la Ventana de Producto */
        $this->product = $this->product->fresh();

          /* Generamos variantes */
          $this->generarVariantes();

        /* Despues de salvar el registro reseteamos variant y Openmodal */
        $this->reset(['variant', 'openModal']);
    }


    public function removeFeature($index)
    {
            /* Eliminamos Valor segun el index recibido desde product-variants.blade */
            unset($this->variant['features'][$index]);
            $this->variant['features'] = array_values($this->variant['features']);  
    }


    public function deleteFeature($option_id, $feature_id){
        $this->product->options()->updateExistingPivot($option_id, [
          'features' => array_filter($this->product->options->find($option_id)->pivot->features, function ($feature) use ($feature_id){
            return $feature['id'] != $feature_id;
          })   
        ]);

        $this->product = $this->product->fresh(); 

         /* Generamos variantes */
         $this->generarVariantes();
    }


    /* Metodo para eliminar Opciones de la ficha de producto */
    public function deleteOption($option_id){
      
      $this->product->options()->detach($option_id);

      $this->product = $this->product->fresh();

       /* Generamos variantes */
       $this->generarVariantes();
    }


public function generarVariantes(){

  $features = $this->product->options->Pluck('pivot.features');

  /* Generamos la combinaciones */
  $combinaciones = $this->generarCombinaciones($features);

   /* Eliminamos Todas la variantes que se crearon anteriormente */
   $this->product->variants()->delete();

   
   /*Creamos nuevas variantes segun las combinaciones posibles */
  foreach ($combinaciones as $combinacion) {
     
    /* Generamos variant por cada combinacion que encuentre */
    $variant = Variant::create([

        'product_id' => $this->product->id,
    ]);

    $variant->features()->attach($combinacion);

  }

}


    /* Metodo para generar combinaciones de variantes */ 
function  generarCombinaciones($arrays, $indice = 0, $combinacion = [])

  {

      if ($indice == count($arrays)){

          return [$combinacion];

      }

      $resultado= [];

      foreach ($arrays[$indice] as $item){

          $combinacionesTemporal = $combinacion;

          $combinacionesTemporal[] = $item['id'];

        $resultado = array_merge($resultado, $this->generarCombinaciones($arrays, $indice + 1, $combinacionesTemporal));

      }

      return  $resultado;

}



   

    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }

  
}
