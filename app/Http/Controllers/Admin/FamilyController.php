<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $families = Family::orderBy('id', 'desc')->paginate(5);
        return view('admin.families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.families.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Aplicamos Validaciones
        $request->validate([
            'name' => 'required'
        ]);

        //Aprobada la validacion > Insertamos datos en la Tabla Families
        Family::create($request->all());

           //Iniciamos una variable de session
           session()->flash('swal', [

            'icon' =>'success',
            'title' => '!Buen Trabajo...¡',
            'text' => 'Registro Exitoso',
            'showConfirmButton'=> false,
            'timer'=> 1800
           ]);

        //retornar a la vista index
        return redirect()->route('admin.families.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Mostramos el formulario para editar un registro especifico.
     */
    public function edit(Family $family)
    {
      return view('admin.families.edit', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {
         

        //Aplicamos Validaciones
        $request->validate([
            'name' => 'required'
        ]);

        //Aprobada la validacion > Actualizamos datos en la Tabla Families
        $family->update($request->all());

        //Iniciamos una variable de session
        session()->flash('swal', [

            'icon' =>'success',
            'title' => '!Buen Trabajo...¡',
            'text' => 'Datos del registro actualizados',
            'showConfirmButton'=> false,
            'timer'=> 1800
        ]);

        //retornar a la vista index
        return redirect()->route('admin.families.edit', $family);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {


       
        //Verificamos si el registro Family cuenta con Categorias Asociadas 
        if ($family->categories->count()>0) {
            session()->flash('swal', [
                'icon'=>'error',
                'title'=>'¡Ups!',
                'text' =>'No se puede eliminar el registro, se relaciona con una categoria'
            ] );
            
            return redirect()->route('admin.families.edit', $family);
        }
        
        $family->delete();
        
        session()->flash('swal',[
            'title' => "Eliminado!",
            'text' => "Registro Eliminado Exitosamente.",
            'icon'=> "success",
            'showConfirmButton'=> false,
            'timer'=> 1800
        ]);
        
        return redirect()->route('admin.families.index');
    }
}
