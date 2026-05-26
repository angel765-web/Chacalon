<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{
    public function index()
    {
        $tipos = TipoProducto::all();
        return view('tipos.index', compact('tipos'));
    }

    public function create()
    {
        return view('tipos.create');
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

        TipoProducto::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('tipos.index')
            ->with('success', 'Tipo de producto registrado.');
    }

    public function edit($id)
    {
        $tipo = TipoProducto::findOrFail($id);
        return view('tipos.edit', compact('tipo'));
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

        $tipo = TipoProducto::findOrFail($id);

        $tipo->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('tipos.index')
            ->with('success', 'Tipo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $tipo = TipoProducto::findOrFail($id);
        $tipo->delete();

        return redirect()->route('tipos.index')
            ->with('success', 'Tipo eliminado.');
    }
}