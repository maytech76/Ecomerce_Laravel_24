<?php

namespace App\Livewire\Forms\Admin\Options;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Option;
use App\Models\Feature;
use Livewire\Form;

class NewOptionForm extends Form
{
    //Definimos las principales propiedades
    
     public $name;
     public $type = 1;
     public $features =[
          
        [
            'value'=>'',
            'description'=>''
        ]
        

     ];

 //Propiedad para el control de apertura y cierre del modal
 public $openModal = false;
    

     //Metodo para las reglas de validacion
     public function rules(){
         /*   dd('Registrando Opcion'); */

      /*   Validamos la informacion a registrar */
      $rules = [

        'name'=>'required',
        'type'=>'required|in:1,2',
        'features'=>'required|array|min:1',

      ];

      foreach ($this->features as $index => $feature) {

        if ($this->type == 1) {
            #texto
            $rules['features.'. $index . '.value'] = 'required';
        }else{
            #color y formato Exadecimal
            $rules['features.'. $index . '.value'] = 'required|regex:/^#[a-f0-9]{6}$/i'; 
          }
          
          #Description
          $rules['features.'. $index . '.description'] = 'required|max:255';
        }

         return $rules;
     }


     //Asignando nombre legible a campos en las reglas de validacion
     public function validationAttributes(){

        $attributes =[
            'name'=>'nombre',
            'type'=>'tipo',
            'features'=>'Valores',

        ];

        foreach ($this->features as $index => $feature) {
            $attributes['features.'.$index.'.value'] = 'Valor';
            $attributes['features.'.$index.'.description'] = 'Descripcion';
        }

        return $attributes;
     }

     //Metodo para Agregar nuevos Valores
     public function addFeature(){

        $this->features[] = [
            'value'=>'',
            'description'=>'',
        ];
    }


    /* Metodo encargado de Eliminar del listado los valores
     no deseados despues de su indercion en la lista */

    public function removeFeature($index){

        /* Eliminamo el features segun el index selecionado */
        unset($this->features[$index]);

        /* Restablecemos los Features no selecionados */
        $this->features = array_values($this->features);
    }


     //Metodo para crear nuevas opciones
     public function save(){

        //Se compruva las validaciones
        $this->validate();

          #insertamos el nuevo registro en la tabla Options
          $option = Option::create([
            'name'=>$this->name,
            'type'=>$this->type,
        ]);

        #paso seguido insertamos nuevo registro en la tabla Features
        foreach ($this->features as $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description'],
            ]);
        }

        //Reseteamos todos los valores del Modal despues de Registrar nueva Option
        $this->reset();

       
     }

    

}
