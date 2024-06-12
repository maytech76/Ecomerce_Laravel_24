<?php

namespace App\Livewire\Admin\Options;

use Livewire\Component;

class AddNewFeature extends Component
{

    public $option;

    public $newFeature = [
        'value' =>'',
        'description'=>'',
    ];

    /* Creamos la funcion addFeature para enviar value y description a DB */

    public function addFeature(){

        /* Aplicamos Validaciones */
        $this->validate([
            'newFeature.value' => 'required',
            'newFeature.description' => 'required',
        ]);

        /* Ahora asignamos el value y la description segun la opcion donde se encuentre */
        $this->option->features()->create($this->newFeature);

       
        $this->dispatch('featureAdded'); /* llamar a dispatch para emitir un evento que lo escuchara un On */

        $this->reset('newFeature'); /* reseteamos los valores */

    }


    public function render()
    {
        return view('livewire.admin.options.add-new-feature');
    }
}
