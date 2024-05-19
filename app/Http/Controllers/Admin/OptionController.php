<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    //Creamos el metodo llamado index
    public function index()
    {
      return view('admin.options.index');
    }
}
