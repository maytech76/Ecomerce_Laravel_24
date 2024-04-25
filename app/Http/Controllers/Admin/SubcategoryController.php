<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::with('category.family')
            ->orderBy('id', 'desc')
              ->paginate(5);
        /* return $subcategories; */
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        return view('admin.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* Aplicamos validaciones para los campos category_id the name */
        $request->validate([
            'category_id'=> 'required|exists:categories,id',
            'name'=>'required|min:6',
        ]);

        //Insertamos el nuevo registro
        Subcategory::create($request->all());

        //Mostramos un flash informativo con SweeAlert
        session()->flash('swal',
                [
                    'icon'=>'success',
                    'title'=>'¡Excelente..!',
                    'text'=>'Sub-Categoria Creada Correctamente..',
                    'showConfirmButton'=> false,
                    'timer'=> 1800
                ]);

        //Redirigimos a la vista Listado de SubCategorias
        return redirect()->route('admin.subcategories.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
       return view('admin.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        //
    }
}
