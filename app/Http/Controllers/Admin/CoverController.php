<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.covers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.covers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      /* Aplicamos validaciones */
      $data = $request->validate([
        'image'     =>'required|image|max:1024',
        'title'     =>'required|string|max:255',
        'star_at'   => 'required|date',
        'end_at'    => 'nullable|date|after_or_equal:star_at',
        'is_active' => 'required|boolean'

     ]);
    
  /*     dd($data); */
      

      /* a la variable $data Agregamos un campo adicional (image) */
      $data['image_path'] = Storage::put('covers', $data['image']);
      $cover = Cover::create($data);


      //Mensaje Sweealert de confirmacion
      session()->flash('swal',[
        'position' => "top-end",
        'title' => "Portada Creada",
        'text' => "El Registro de portada fue Exitoso.",
        'icon'=> "success",
        'showConfirmButton'=> false,
        'timer'=> 1800
      ]);

      return redirect()->route('admin.covers.edit', $cover);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Cover $cover)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cover $cover)
    {
        return view('admin.covers.edit', compact('cover'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cover $cover)
    {
         /* Aplicamos validaciones */
      $data = $request->validate([

        'image'     =>'nullable|image|max:1024',
        'title'     =>'required|string|max:255',
        'star_at'   => 'required|date',
        'end_at'    => 'nullable|date|after_or_equal:star_at',
        'is_active' => 'required|boolean'

      ]);

       if (isset($data['image'])) {
        
         Storage::delete($cover->image_path); /* Si existe una imagen en el registro eliminarla */
       
        $data['image_path'] = Storage::put('covers', $data['image']);/*  Agregamos la nueva imagen */
        
       }
    
       $cover->update($data);

            //Mensaje Sweealert de confirmacion
        session()->flash('swal',[
            'position' => "top-end",
            'title' => "Portada Actualizada",
            'icon'=> "success",
            'showConfirmButton'=> false,
            'timer'=> 1800
        ]);

        return redirect()->route('admin.covers.edit', $cover);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cover $cover)
    {
        //
    }
}
