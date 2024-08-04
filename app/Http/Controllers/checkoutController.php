<?php

namespace App\Http\Controllers;

use App\Models\User;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class checkoutController extends Controller
{
    public function index()
    {

       return view('checkout.index');
    }



    
}
