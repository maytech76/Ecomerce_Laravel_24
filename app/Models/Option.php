<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
     //Habiltar Asigancion Masiva
     protected $fillable = [
        'name',
        'type'
    ];

     /* Relacion Muchos a Muchos con Model Product */

     public function products(){
        return $this->belongsToMany(Product::class)
         ->withPivot('value')
         ->withTimestamps();
    }


    /* Relacion una option con muchos Feature */
    public function features(){
        return $this->hasMany(Feature::class);
    }
}

