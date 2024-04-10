<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

     //Habiltar Asigancion Masiva
     protected $fillable = [
        'name',
        'family_id'
    ];

    /* Reflacion con modelo Family muchas Categorias pertenece a una Familia */  
    public function famyly(){
        return $this->belongsTo(Family::class);
    }


    /* Una Categoria contiene muchas SubCategorias */
    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }


}
