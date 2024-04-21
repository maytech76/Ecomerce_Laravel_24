<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')
        ->with('family') /* Precargamos la relacion con family por medio del campo family_id */
        ->paginate(5);
        /* return $categories; */
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* Creamos variable $families donde almacenaremos el listado de familias y enviarlos a la vista categories->create */
        $families = Family::all();
        return view('admin.categories.create', compact('families'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* Aplicamos validaciones para los campos family_id the name */
        $request->validate([
            'family_id'=> 'required|exists:families,id',
            'name'=>'required|min:6',
        ]);

        //Insertamos el nuevo registro
        Category::create($request->all());
       
        //Mostramos un flash informativo con SweeAlert
        session()->flash('swal',
                [
                    'icon'=>'success',
                    'title'=>'¡Excelente..!',
                    'text'=>'Categoria Creada Correctamente..',
                    'showConfirmButton'=> false,
                    'timer'=> 1800
                ]);

        //Redirigimos a la vista Listado de Categorias
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $families = Family::all();
        return view('admin.categories.edit', compact('category', 'families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
       /*  return $request->all(); */

       //Validamos que es un campo requerido y debe existir
       $request->validate([
          'family_id'=> 'required|exists:families,id',
          'name'=> 'required',
       ]);

       //Actualizamos el registro con todos los campos recibidos
       $category->update($request->all());

       //Mostramos un flash informativo con SweeAlert
       session()->flash('swal',
       [
           'icon'=>'success',
           'title'=>'¡Excelente..!',
           'text'=>'Categoria Actualizada Correctamente..',
           'showConfirmButton'=> false,
           'timer'=> 1800
       ]);

       return redirect()->route('admin.categories.edit', $category);
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
         //Verificamos si el registro Family cuenta con Categorias Asociadas 
         if ($category->subcategories->count()>0) {
            session()->flash('swal', [
                'icon'=>'error',
                'title'=>'¡Ups!',
                'text' =>'No se puede eliminar el registro, se relaciona con una Sub Categoria'
            ] );
            
            return redirect()->route('admin.categories.edit', $category);
        }
        
        $category->delete();
        
        session()->flash('swal',[
            'title' => "Eliminado!",
            'text' => "Registro Eliminado Exitosamente.",
            'icon'=> "success",
            'showConfirmButton'=> false,
            'timer'=> 1800
        ]);
        
        return redirect()->route('admin.categories.index');
    }
}
