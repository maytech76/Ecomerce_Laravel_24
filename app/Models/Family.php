<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Family extends Model
{
    use HasFactory;

    //Habiltar Asigancion Masiva
    protected $fillable = [
        'name'
    ];

    //Relacion una famila muchas categorias
    public function categories(){
        return $this->hasMany(Category::class);
    }
}
