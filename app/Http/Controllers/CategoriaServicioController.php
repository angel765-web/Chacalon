<?php

namespace App\Http\Controllers;

use App\Models\CategoriaServicio;
use Illuminate\Http\Request;

class CategoriaServicioController extends Controller
{
    public function index()
    {
        $categorias = CategoriaServicio::all();
        return view('catalogo_servicios.index', compact('categorias'));
    }

    public function create()
    {
        return view('catalogo_servicios.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|max:100']);
        CategoriaServicio::create($request->all());
        return redirect()->route('catalogo_servicios.index')->with('success', 'Categoría de servicio guardada.');
    }

    public function edit($id)
    {
        $categoria = CategoriaServicio::findOrFail($id);
        return view('catalogo_servicios.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nombre' => 'required|max:100']);
        $categoria = CategoriaServicio::findOrFail($id);
        $categoria->update($request->all());
        return redirect()->route('catalogo_servicios.index')->with('success', 'Categoría actualizada.');
    }

    public function destroy($id)
    {
        $categoria = CategoriaServicio::findOrFail($id);
        $categoria->delete();
        return redirect()->route('catalogo_servicios.index')->with('success', 'Categoría eliminada.');
    }
}
