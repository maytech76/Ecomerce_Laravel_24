<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Variant extends Model
{
    use HasFactory;
    
     //Habiltar Asigancion Masiva
     protected $fillable = [
        'sku',
        'image_path',
        'stock',
        'product_id'
    ];


    /* Declaramos una nueva funcion para establecer atributos adicionales */
    protected function image(): Attribute{
        return Attribute::make( 
       get: fn() =>$this->image_path ? Storage::url($this->image_path):asset('img/not_image.png')
        );
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    /* Relacion muchos a muchos con el Modelo Feature */
    public function features(){
        return $this->belongsToMany(Feature::class)
        ->withTimestamps();
    }
}
