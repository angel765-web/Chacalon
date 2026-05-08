<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\CategoriaServicio;
use App\Models\Venta;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::with('categoria')->get();
        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        $categorias = CategoriaServicio::all();
        $ventas = Venta::all();

        return view('servicios.create', compact('categorias', 'ventas'));
    }

    public function store(Request $request)
    {
        Servicio::create([
            'id_venta' => $request->id_venta,
            'id_categoria_servicio' => $request->id_categoria_servicio,
            'monto' => $request->monto,
            'comision' => $request->comision ?? 0
        ]);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio registrado correctamente');
    }
}
