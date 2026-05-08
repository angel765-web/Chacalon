<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Inventario;
use App\Models\Servicio;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $hoy = now()->toDateString();

        // 📊 métricas
        $ventasHoy = Venta::whereDate('fecha', $hoy)->count();
        $totalHoy = Venta::whereDate('fecha', $hoy)->sum('total');

        $inventarioTotal = Inventario::sum('cantidad');
        $stockBajo = Inventario::where('cantidad', '<', 5)->count();

        // 🧾 ventas
        $ventas = Venta::with('detalles.producto.producto')
            ->orderBy('id_venta', 'desc')
            ->take(5)
            ->get();

        // 🛠️ servicios
        $servicios = Servicio::orderBy('id_servicio', 'desc')
            ->take(5)
            ->get();

        // 🔥 actividad unificada
        $actividad = collect();

        foreach ($ventas as $venta) {
            $actividad->push([
                'tipo' => 'venta',
                'fecha' => $venta->fecha,
                'total' => $venta->total,
                'detalles' => $venta->detalles,
            ]);
        }

        foreach ($servicios as $servicio) {
            $actividad->push([
                'tipo' => 'servicio',
                'nombre' => $servicio->nombre ?? 'Servicio sin nombre',
                'total' => $servicio->precio ?? 0, 
                'fecha' => $servicio->created_at,
            ]);
        }

        $actividad = $actividad->sortByDesc('fecha')->values()->take(8);

        return view('home', compact(
            'ventasHoy',
            'totalHoy',
            'inventarioTotal',
            'stockBajo',
            'actividad'
        ));
    }
}