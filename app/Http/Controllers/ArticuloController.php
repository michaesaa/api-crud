<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

class ArticuloController extends Controller
{

    public function index()
    {
        $articulos = Articulo::all();
        return $articulos;
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $articulo = new Articulo();
        $articulo->description = $request->description;
        $articulo->precio = $request->precio;
        $articulo->stock = $request->stock;

        $articulo->sace();
    }

    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request)
    {
        $articulo = Articulo::finOrFail($request->id);
        $articulo->description = $request->description;
        $articulo->precio = $request->precio;
        $articulo->stock = $request->stock;
        $articulo->save();

        return $articulo;
    }

 
    public function destroy(string $id)
    {
        $articulo = Articulo::destroy($id);
        return $articulo;
    }
}
