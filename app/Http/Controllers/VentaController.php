<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\CrearProducto;
use App\Models\Inventario;
use App\Models\CategoriaServicio;
use App\Models\Servicio;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $ventas = Venta::with(['detalles', 'servicios'])->get();
        return view('ventas.index', compact('ventas'));
    }

    // ================= CREATE =================
    public function create()
    {
        $productos = CrearProducto::with('producto')->get();
        $categorias = CategoriaServicio::all();

        return view('ventas.create', compact('productos', 'categorias'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $venta = Venta::create([
            'fecha' => now(),
            'total' => 0
        ]);

        $total = 0;

        // ================= PRODUCTOS =================
        if ($request->has('productos')) {

            foreach ($request->productos as $item) {

                $idProducto = $item['id_crea_producto'] ?? null;
                $cantidad = $item['cantidad'] ?? 0;

                if (!$idProducto || $cantidad <= 0) {
                    continue;
                }

                $producto = CrearProducto::find($idProducto);

                if (!$producto) {
                    continue;
                }

                $subtotal = $producto->precio_venta * $cantidad;
                $total += $subtotal;

                DetalleVenta::create([
                    'id_venta' => $venta->id_venta,
                    'id_crea_producto' => $idProducto,
                    'cantidad' => $cantidad
                ]);

                //  DESCONTAR INVENTARIO
                $inventario = Inventario::where('id_crea_producto', $idProducto)->first();

                if ($inventario) {
                    $inventario->cantidad -= $cantidad;
                    $inventario->save();
                }
            }
        }

        // ================= SERVICIOS =================
        if ($request->has('servicios')) {

            foreach ($request->servicios as $item) {

                $idServicio = $item['id_categoria_servicio'] ?? null;
                $monto = $item['monto'] ?? 0;
                $comision = $item['comision'] ?? 0;

                if (!$idServicio || $monto <= 0) {
                    continue;
                }

                Servicio::create([
                    'id_venta' => $venta->id_venta,
                    'id_categoria_servicio' => $idServicio,
                    'monto' => $monto,
                    'comision' => $comision
                ]);

                $total += $monto;
            }
        }

        // ================= TOTAL FINAL =================
        $venta->update([
            'total' => $total
        ]);

        return redirect()->route('ventas.index')
            ->with('success', 'Venta registrada correctamente');
    }
}