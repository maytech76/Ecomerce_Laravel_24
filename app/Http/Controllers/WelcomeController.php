<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cover;
use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $covers =Cover::where('is_active', true)    /* Mostrar covers que su campo is_active = true */
                ->whereDate('star_at', '<=', now()) /* Donde la fecha star_at sea menor a fecha actual */
                ->where(function($query){
                    $query->whereDate('end_at', '>=', now(0))
                          ->orWhereNull('end_at');
                 }) 
                  ->get();

             /* mostrar un listado de los ultimos 12 productos registrado ordenados descendente */
            $lastProducts = Product::orderBy('created_at', 'asc')
                           ->get()
                           ->take(12);

                           /*  dd($lastProducts)->Array(); */

        return view('welcome', compact('covers', 'lastProducts'));
    }
}
