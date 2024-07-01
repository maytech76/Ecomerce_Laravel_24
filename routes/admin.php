<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OptionController;


Route::get('/' , function(){return view('admin.dashboard');
   })->name('dashboard');

Route::get('/options', [OptionController::class, 'index'])->name('options.index');

Route::resource('families', FamilyController::class);
Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);


/* Definimos una nueva ruta que se encargara de la edicion de imagenes para las variantes */
Route::get('product/{product}/variants/{variant}', [ProductController::class, 'variants'])
     ->name('products.variants')
     ->scopeBindings();

/* Definimos una nueva ruta que se encargará de la edicion de SKU - STOCK de una variante */
Route::put('product/{product}/variants/{variant}', [ProductController::class, 'variantsUpdate'])
     ->name('products.variantsUpdate')
     ->scopeBindings();



