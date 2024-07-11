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

    public function scopeVerifyFamily($query, $family_id)
    {
        $query->when($family_id, function($query, $family_id){

          /* muestra los productos que tenga relacion con una subcategoria esta 
                    con una categpria segun el id de familia suminisrado */
          $query->whereHas('subcategory.category', function($query) use ($family_id)
          {
            $query->where('family_id', $family_id);
          });
      });
    }


    public function scopeVerifyCategory($query, $category_id)
    {
      $query->when($category_id, function($query, $category_id){
        $query->whereHas('subcategory', function($query) use($category_id){
          $query->where('category_id', $category_id);
        });
     });
    }

    public function scopeVerifySubcategory($query, $subcategory_id)
    {
      $query->when($subcategory_id, function($query) use ($subcategory_id) {
          $query->where('subcategory_id', $subcategory_id);
        }); 
    }


    public function scopeCustomOrder($query, $orderBy)
    {
        $query->when($orderBy == 1, function($query){
          $query->orderBy('created_at', 'desc');
        })
        ->when($orderBy == 2, function($query){
            $query->orderBy('price', 'desc');
        })
        ->when($orderBy == 3, function($query){
            $query->orderBy('price', 'asc');
        });
    }

    public function scopeSelectFeatures($query, $selected_features)
    {
      $query->when($selected_features, function($query ) use ($selected_features){ /* Ejecuta esta consulta si existe un feature selecionad */
        /* consulta las relaciones entre variants y features que contengan el feature_id selecionado */
        $query->whereHas('variants.features', function ($query) use ($selected_features){ 
            $query->whereIn('features.id', $selected_features);
        });
     });
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
