<?php

namespace App\Http\Controllers;

use App\Models\Marca; 
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all(); 
        return view('marcas.index', compact('marcas')); 
    }

    public function create()
    {
        // LÓGICA: Solo muestra el formulario de creación
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100'
        ]);

        Marca::create($request->all());

        return redirect()->route('marcas.index')->with('success', '¡Marca agregada con éxito!');
    }

    public function edit($id)
    {
        // LÓGICA: Busca la marca por ID y nos lleva al formulario con sus datos
        $marca = Marca::findOrFail($id);
        return view('marcas.edit', compact('marca'));
    }

    // LÓGICA: Toma los nuevos datos y los guarda sobre los viejos
    public function update(Request $request, $id)
    {
        $request->validate(['nombre' => 'required|max:100']);
        $marca = Marca::findOrFail($id);
        $marca->update($request->all());

        return redirect()->route('marcas.index')->with('success', '¡Marca actualizada!');
    }

    // LÓGICA: Recibe el ID, busca la marca y la borra físicamente de la tabla
    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();

        return redirect()->route('marcas.index')->with('success', '¡Marca eliminada correctamente!');
    }
}
