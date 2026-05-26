<?php

namespace App\Http\Controllers;

use App\Models\Calidad;
use Illuminate\Http\Request;

class CalidadController extends Controller
{
    public function index()
    {
        $calidades = Calidad::all();
        return view('calidades.index', compact('calidades'));
    }

    public function create()
    {
        return view('calidades.create');
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

        Calidad::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('calidades.index')
            ->with('success', 'Calidad agregada correctamente.');
    }

    public function edit($id)
    {
        $calidad = Calidad::findOrFail($id);
        return view('calidades.edit', compact('calidad'));
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

        $calidad = Calidad::findOrFail($id);

        $calidad->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('calidades.index')
            ->with('success', 'Calidad actualizada.');
    }

    public function destroy($id)
    {
        $calidad = Calidad::findOrFail($id);
        $calidad->delete();

        return redirect()->route('calidades.index')
            ->with('success', 'Calidad eliminada.');
    }
}