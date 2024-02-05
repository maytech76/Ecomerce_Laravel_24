<?php

use Illuminate\Support\Facades\Route;

Route::get('/' , function(){
   return "dashdboard Admin";
})->name('Dashboard');