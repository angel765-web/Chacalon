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
        $request->validate(['nombre' => 'required|max:100']);
        Calidad::create($request->all());
        return redirect()->route('calidades.index')->with('success', 'Calidad agregada correctamente.');
    }

    public function edit($id)
    {
        $calidad = Calidad::findOrFail($id);
        return view('calidades.edit', compact('calidad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nombre' => 'required|max:100']);
        $calidad = Calidad::findOrFail($id);
        $calidad->update($request->all());
        return redirect()->route('calidades.index')->with('success', 'Calidad actualizada.');
    }

    public function destroy($id)
    {
        $calidad = Calidad::findOrFail($id);
        $calidad->delete();
        return redirect()->route('calidades.index')->with('success', 'Calidad eliminada.');
    }
}
