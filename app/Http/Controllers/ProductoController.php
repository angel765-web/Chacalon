<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:150',

                // 🔥 solo letras y espacios (sin números ni símbolos)
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ],
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se permiten letras, no números ni símbolos',
        ]);

        Producto::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto base registrado.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:150',

                // 🔥 misma validación
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ],
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se permiten letras, no números ni símbolos',
        ]);

        $producto = Producto::findOrFail($id);

        $producto->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado.');
    }
}