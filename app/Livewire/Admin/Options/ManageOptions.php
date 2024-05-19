<?php

namespace App\Livewire\Admin\Options;

use Livewire\Component;
use App\Models\Option;

class ManageOptions extends Component
{
    //Declaramos una variable
    public $options;

    //Llamamos el metodo mount, con el que llamaremos al metodo all al cargar este archivo
    public function mount()
    {
        //Para evitar la doble lectura de querys solicitamos a laravel enviar los features relacionados con la opcion
        $this->options = Option::with('features')->get();
    }

    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
