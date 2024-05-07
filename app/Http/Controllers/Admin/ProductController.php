<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
}
