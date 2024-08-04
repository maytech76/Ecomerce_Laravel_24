<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Variant;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\CheckoutController;
use CodersFree\Shoppingcart\Facades\Cart;



/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

/* ruta para controllar familias */
Route::get('families/{family}', [FamilyController::class, 'show'])->name('families.show');


/* Ruta para controlar las consultas por categorias */
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');


/* Ruta para direccionar las peticiones a la vista Subcategories */
Route::get('subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');


/* Ruta para direccionar las peticiones a la vista Productos */
Route::get('products/{product}',[ProductController::class, 'show'])->name('products.show');


/* Ruta para direccionar las peticiones a la vista cart */
Route::get('cart', [CartController::class, 'index'])->name('cart.index');

Route::get('shipping', [ShippingController::class, 'index'])->name('shipping.index');

Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
});




/* Funciones Recursivas */
Route::get('prueba', function () {

    Cart::instance('shopping');

  return Cart::content();

});

 