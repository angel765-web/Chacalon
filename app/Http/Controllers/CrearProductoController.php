<?php

namespace App\Http\Controllers;

use App\Models\CrearProducto;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Calidad;
use App\Models\TipoProducto;
use Illuminate\Http\Request;

class CrearProductoController extends Controller
{
    public function index()
    {
        $productos = CrearProducto::with([
            'producto',
            'marca',
            'tipoProducto',
            'calidad'
        ])->get();

        return view('crear_productos.index', compact('productos'));
    }

    public function create()
    {
        $productos = Producto::all();
        $marcas = Marca::all();
        $calidades = Calidad::all();
        $tipos = TipoProducto::all();

        return view('crear_productos.create', compact(
            'productos',
            'marcas',
            'calidades',
            'tipos'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required',
            'id_tipo_producto' => 'required',
            'id_marca' => 'required',
            'id_calidad' => 'required',
            'precio_venta' => 'required|numeric'
        ]);

        CrearProducto::create($request->all());

        return redirect()->route('crear_productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    public function edit($id)
    {
        $crear = CrearProducto::findOrFail($id);

        $productos = Producto::all();
        $marcas = Marca::all();
        $calidades = Calidad::all();
        $tipos = TipoProducto::all();

        return view('crear_productos.edit', compact(
            'crear',
            'productos',
            'marcas',
            'calidades',
            'tipos'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_producto' => 'required',
            'id_tipo_producto' => 'required',
            'id_marca' => 'required',
            'id_calidad' => 'required',
            'precio_venta' => 'required|numeric'
        ]);

        $crear = CrearProducto::findOrFail($id);
        $crear->update($request->all());

        return redirect()->route('crear_productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $crear = CrearProducto::findOrFail($id);
        $crear->delete();

        return redirect()->route('crear_productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}