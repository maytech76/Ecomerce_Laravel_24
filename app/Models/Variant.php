<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    
     //Habiltar Asigancion Masiva
     protected $fillable = [
        'sku',
        'image_path',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    /* Relacion muchos a muchos con el Modelo Feature */
    public function features(){
        return $this->belongsToMany(Feature::class)
        ->withTimestamps();
    }
}
