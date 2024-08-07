<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
     //Habiltar Asigancion Masiva
     protected $fillable = [
        'sku',
        'name',
        'description',
        'images_path',
        'price',
        'stock',
        'subcategory_id'
    ];

    /* muchos productos pertenecen un una Subcategoria */
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }


   /*  un productos tiene muchas variantes */
    public function variants(){
        return $this->hasMany(Variant::class);
    }

    /* Relacion Muchos a Muchos con Model Option */
    public function options(){
        return $this->belongsToMany(Option::class)
        ->using(OptionProduct::class)
        ->withPivot('features')
        ->withTimestamps();
    }

     /* Creamos un Accesor para image */
     protected function image(): Attribute
     {
       /* Retorname una url a partir del campo image_path */
       return Attribute::make(
         get: fn() => Storage::url($this->image_path),
       );
     }
}
