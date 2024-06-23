<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OptionProduct extends Pivot   
{
    use HasFactory;

    /* Definimos nuestra propiedad casts donde indicamos que el campo
    features se convertira en un array */

    protected $casts = [
        'features' => 'array'
    ];
}
