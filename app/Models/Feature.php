<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

     //Habiltar Asigancion Masiva
     protected $fillable = [
        'value',
        'description',
        'option_id'
    ];

    /* Relacion uno a muchos inversa */
    public function option(){
        return $this->belongsTo(Option::class);
    }

     /* Relacion Muchos a Muchos con Model Variant */
     public function variants(){
        return $this->belongsToMany(Variant::class)
        ->withTimestamps();
     }


}
