<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

     //Habiltar Asigancion Masiva
     protected $fillable = [
        'name',
        'category_id'
    ];

     /* Relacion con modelo Category muchas Subcategorias pertenece a una Category */  
     public function category(){
        return $this->belongsTo(Category::class);
    }


   /*  Definimos la relacion con products uno a muchos*/
   public function products(){
    return $this->hasMany(Product::class);
}


}
