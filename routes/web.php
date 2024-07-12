<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Variant;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;


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

  $product = Product::find(150);

  $features = $product->options->Pluck('pivot.features');

  $combinaciones = generarCombinaciones($features);

  /* Eliminamos Todas la variantes que se crearon anteriormente */
  $product->variants()->delete();



  /* Creamos nuevas variantes segun las combinaciones posibles */
  foreach ($combinaciones as $combinacion) {
     
    /* Generamos variant por cada combinacion que encuentre */
    $variant = Variant::create([

        'product_id' => $product->id,
    ]);

    $variant->features()->attach($combinacion);

  }

  return 'Variantes Creadas';


});

 function  generarCombinaciones($arrays, $indice = 0, $combinacion = [])

    {

        if ($indice == count($arrays)){

            return [$combinacion];

        }

        $resultado= [];

        foreach ($arrays[$indice] as $item){

            $combinacionesTemporal = $combinacion;

            $combinacionesTemporal[] = $item['id'];

        $resultado = array_merge($resultado, generarCombinaciones($arrays, $indice + 1, $combinacionesTemporal));

        }

        return  $resultado;

    } 
