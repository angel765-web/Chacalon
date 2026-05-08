<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\CrearProducto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::with('productoCreado')->get();

        return view('inventarios.index', compact('inventarios'));
    }

    public function create()
    {
        $productos = CrearProducto::all();

        return view('inventarios.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_crea_producto' => 'required',
            'precio_compra' => 'required|numeric',
            'cantidad' => 'required|integer',
            'fecha' => 'required|date'
        ]);

        Inventario::create($request->all());

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario agregado correctamente');
    }

    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);
        $productos = CrearProducto::all();

        return view('inventarios.edit', compact('inventario', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_crea_producto' => 'required',
            'precio_compra' => 'required|numeric',
            'cantidad' => 'required|integer',
            'fecha' => 'required|date'
        ]);

        $inventario = Inventario::findOrFail($id);
        $inventario->update($request->all());

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario actualizado');
    }

    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario eliminado');
    }
}