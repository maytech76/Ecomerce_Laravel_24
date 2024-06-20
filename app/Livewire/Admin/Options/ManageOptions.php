<?php

namespace App\Livewire\Admin\Options;


use App\Livewire\Forms\Admin\Options\NewOptionForm;
use Livewire\Component;
use App\Models\Option;
use Livewire\Attributes\On;
use App\Models\Feature;


class ManageOptions extends Component
{
    //Declaramos una propiedad a la que le agregaremos las consulta de Option
    public $options;

   


    //Propiedad donde definimos los diferentes valores y argumento para una nueva option
    public NewOptionForm $newOption ;


    //Llamamos el metodo mount, con el que llamaremos al metodo all al cargar este archivo
    //se cargaran todos los registros de la tabla options y features
    public function mount(){
            //Para evitar la doble lectura de querys solicitamos a laravel enviar los features relacionados con la opcion
            $this->options = Option::with('features')->get();
    }


    /* Aplicamos un metodo llamado updateOptionsList, que recargara el listado de opciones y valores */

    #[On('featureAdded')]
    public function updateOptionsList(){

     #Mostramos Alerta SweeAlert
      $this->dispatch('swal',[
        'position' => "top-end",
        'text' => "Registro Efectuado",
        'icon'=> "success",
        'showConfirmButton'=> false,
        'timer'=> 1500
       
       ]);

        $this->options = Option::with('features')->get();
    }

    /* llamamos al Metodo encargado del nuevo registro de Valores */
    public function addFeature(){

        $this->newOption->addFeature();

    }


    /* Eliminamos al valor seccionado por medio de su id */
    public  function deleteFeature(Feature $feature){
        /* $this->newOption->deleteFeature($feature->id); */
        /* dd($feature); */
        $feature->delete();

        /* refrescando el listado de Opciones */

        $this->options = Option::with('features')->get();

    }  

    /* Metodo para eliminar Opcion */
    public function deleteOption(Option $option)
    {
       $option->delete(); /* Aplicamos el metodo delete a la opcion selecionada */
       $this->options = Option::with('features')->get(); /* Refrescamos el listado de opciones */
    }



    /* Metodo encargado de Eliminar del listado los valores
     no deseados despues de su indercion en la lista */

    public function removeFeature($index){
   
        $this->newOption->removeFeature($index);
    }

    /* Metodo para Agregar nueva opcion con sus valores a la base de datos  */
    public function addOption(){

     //registramos una nueva opcion usando el metodo save que esta en el WewOptionForm
     $this->newOption->save(); 
      
      #refrescamos la vista de opciones
      $this->options = Option::with('features')->get();


      #Mostramos Alerta SweeAlert
      $this->dispatch('swal',[
        'title' => "Bien Echo..!",
        'text' => "Registro Exitosamente.",
        'icon'=> "success",
        'showConfirmButton'=> false,
        'timer'=> 1800
       ]);

    }

    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
