<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\CrearProducto;
use Illuminate\Http\Request;
// SOLUCIÓN AL ERROR: Importamos la fachada DB obligatoria para las consultas Query Builder
use Illuminate\Support\Facades\DB; 

class InventarioController extends Controller
{
    public function index()
    {
        $existencias = DB::table('inventarios')
        ->join('crear_productos', 'inventarios.id_crea_producto', '=', 'crear_productos.id_crea_producto')
        ->join('productos', 'crear_productos.id_producto', '=', 'productos.id_producto')
        ->join('tipo_productos', 'crear_productos.id_tipo_producto', '=', 'tipo_productos.id_tipo_producto')
        ->join('marcas', 'crear_productos.id_marca', '=', 'marcas.id_marca')
        ->select(
            'productos.nombre as producto_nombre',
            'tipo_productos.nombre as tipo_nombre',
            'marcas.nombre as marca_nombre',
            'crear_productos.id_crea_producto',
            DB::raw('SUM(inventarios.cantidad) as total_cantidad')
        )
        ->groupBy(
            'crear_productos.id_crea_producto',
            'productos.nombre',
            'tipo_productos.nombre',
            'marcas.nombre'
        )
        ->get();

        return view('inventarios.index', compact('existencias'));
    }

    // NUEVO MÉTODO: Trae el historial de todos los movimientos individuales
    public function historial(Request $request)
    {
        // Iniciamos la consulta base usando Eloquent para conservar tus relaciones originales
        $query = Inventario::with(['productoCreado.producto', 'productoCreado.marca', 'productoCreado.tipoProducto']);

        // Si el usuario viene filtrando por un producto específico desde el botón "Ver Detalle"
        if ($request->has('producto')) {
            $query->where('id_crea_producto', $request->producto);
        }

        // Ordenamos los registros del más nuevo al más antiguo
        $inventarios = $query->latest('fecha')->get();

        return view('inventarios.historial', compact('inventarios'));
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
        // Buscamos por la llave primaria correcta de tu tabla
        $inventario = Inventario::where('id_inventario', $id)->firstOrFail();
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

        $inventario = Inventario::where('id_inventario', $id)->firstOrFail();
        $inventario->update($request->all());

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario actualizado');
    }

    public function destroy($id)
    {
        $inventario = Inventario::where('id_inventario', $id)->firstOrFail();
        $inventario->delete();

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario eliminado');
    }
}
