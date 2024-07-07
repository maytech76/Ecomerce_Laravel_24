<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MOdels\Family;
use App\MOdels\Option;

class FamilyController extends Controller
{
    public function show(Family $family)
    {
        /* $options = Option::whereHas('products.subcategory.category', function($query) use ($family){

           $query->where('family_id', $family->id);

           
        })->with([
            'features' => function($query) use ($family){
               $query->whereHas('variants.product.subcategory.category', function($query) use ($family) {
                $query->where('family_id', $family->id);
               });
            }
        ])
        ->get(); */
        
       /*  return $options; */

        return view('families.show', compact('family'));
    }
}
