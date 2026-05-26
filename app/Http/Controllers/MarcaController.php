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
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ]
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se permiten letras, no números ni símbolos',
        ]);

        Marca::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('marcas.index')
            ->with('success', '¡Marca agregada con éxito!');
    }

    public function edit($id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ]
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se permiten letras, no números ni símbolos',
        ]);

        $marca = Marca::findOrFail($id);

        $marca->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('marcas.index')
            ->with('success', '¡Marca actualizada!');
    }

    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();

        return redirect()->route('marcas.index')
            ->with('success', '¡Marca eliminada correctamente!');
    }
}