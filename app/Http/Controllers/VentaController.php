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
    public function index(Request $request)
    {
        $fechaFiltro = $request->get('fecha_busqueda', now()->toDateString());

        $ventas = Venta::with(['detalles.producto', 'servicios.categoria'])
            ->whereDate('fecha', $fechaFiltro)
            ->latest('id_venta')
            ->get();

        return view('ventas.index', compact('ventas', 'fechaFiltro'));
    }

    // ================= CREATE =================
    public function create()
    {
        // Traemos las relaciones correctas para evitar errores de carga en la vista
        $productos = CrearProducto::with(['producto', 'marca', 'tipoProducto'])
            ->select('crear_productos.*')
            ->selectSub(function($query) {
                $query->from('inventarios')
                    ->selectRaw('COALESCE(SUM(cantidad), 0)')
                    ->whereColumn('inventarios.id_crea_producto', 'crear_productos.id_crea_producto');
            }, 'stock_actual')
            ->get();

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
                $cantidad = (int)($item['cantidad'] ?? 0);

                if (!$idProducto || $cantidad <= 0) {
                    continue;
                }

                $producto = CrearProducto::find($idProducto);

                if (!$producto) {
                    continue;
                }

                // RESPALDO DE SEGURIDAD EN SERVIDOR: Validamos stock real antes de guardar
                $stockDisponible = Inventario::where('id_crea_producto', $idProducto)->sum('cantidad');
                if ($cantidad > $stockDisponible) {
                    // Si por alguna razón se salta el JS, cancelamos la transacción y avisamos
                    $venta->delete();
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['stock' => "El producto {$producto->producto->nombre} no tiene suficientes existencias."]);
                }

                $subtotal = $producto->precio_venta * $cantidad;
                $total += $subtotal;

                DetalleVenta::create([
                    'id_venta' => $venta->id_venta,
                    'id_crea_producto' => $idProducto,
                    'cantidad' => $cantidad
                ]);

                // CORRECCIÓN: Creamos un registro de salida (CANTIDAD NEGATIVA) en tu Kardex/Inventario
                Inventario::create([
                    'id_crea_producto' => $idProducto,
                    'precio_compra'    => 0, // Las salidas no tienen costo de compra directo aquí
                    'cantidad'         => -$cantidad, // El signo de menos (-) resta del stock global al sumar
                    'fecha'            => now()->toDateString()
                ]);
            }
        }

        // ================= SERVICIOS =================
        if ($request->has('servicios')) {

            foreach ($request->servicios as $item) {

                $idServicio = $item['id_categoria_servicio'] ?? null;
                $monto = (float)($item['monto'] ?? 0);
                $comision = (float)($item['comision'] ?? 0);

                if (!$idServicio || $monto <= 0) {
                    continue;
                }

                Servicio::create([
                    'id_venta' => $venta->id_venta,
                    'id_categoria_servicio' => $idServicio,
                    'monto' => $monto,
                    'comision' => $comision
                ]);

                $total += ($monto + $comision);
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
