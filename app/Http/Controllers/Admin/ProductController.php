<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')
        ->paginate(6);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //Primero Eliminamos la imagen del producto
        Storage::delete($product->images_path);

        //Elecutamos la funcion delete
        $product->delete();

        //Mensaje Sweealert de confirmacion
        session()->flash('swal',[
            'title' => "Eliminado!",
            'text' => "Registro Eliminado Exitosamente.",
            'icon'=> "success",
            'showConfirmButton'=> false,
            'timer'=> 1800
        ]);

        //redireccionamos al lista de productos
        return redirect()->route('admin.products.index');
    }

    public function variants(Product $product, Variant $variant){
        
        /* retornar vista admin.products.variants, usando dos parametros (product, variant) */
        return view('admin.products.variants', compact('product', 'variant'));
    }

    public function variantsUpdate(Request $request, Product $product, Variant $variant)
    {
       /* Aplicamos Validaciones a las repuestas que recibimos */
       $data = $request->validate([

           'image' => 'nullable|image|max:1024',
           'sku'   => 'required',
           'stock' => 'required|numeric|min:0'

       ]);


       /* Verificamos si se esta recibiendo alguna imagen */
       if ($request->image) {

         if ($variant->image_path) {
            Storage::delete($variant->image_path); /* Si existe una image, Eliminarlaaa */
         }
         
        $data['image_path'] = $request->image->store('products'); /* la imagen recibida en la variable $data la asignamos a parametro image  */

       }

        $variant->update($data); /* Acualizamos los datos a variant con los datos suministrados por $data */

        //Mensaje Sweealert de confirmacion
        session()->flash('swal',[
            'title' => "Bien echo..!",
            'text' => "La variante se Actualizo Exitosamente.",
            'icon'=> "success",
            'showConfirmButton'=> false,
            'timer'=> 1800
        ]);

        return redirect()->route('admin.products.variants', [$product, $variant]);
    }
}
