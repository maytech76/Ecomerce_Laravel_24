<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cover;

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


        return view('welcome', compact('covers'));
    }
}
