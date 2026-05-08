@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="p-5 mb-4 text-white rounded-4 shadow"
         style="background: linear-gradient(135deg,#1e3a8a,#2563eb);">

        <h1 class="fw-bold">📚 Papeleria Mayliz</h1>
        <p class="mb-0 opacity-75">
            Resumen de ventas, inventario y servicios
        </p>

    </div>

    <!-- CARDS PRINCIPALES -->
    <div class="row g-4">

        <div class="col-md-3">
            <div class="card shadow border-0 rounded-4 text-white bg-primary">
                <div class="card-body text-center">
                    <h6>Ventas Hoy</h6>
                    <h2 class="fw-bold">{{ $ventasHoy }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow border-0 rounded-4 text-white bg-success">
                <div class="card-body text-center">
                    <h6>Total Hoy</h6>
                    <h2 class="fw-bold">${{ $totalHoy }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow border-0 rounded-4 text-dark bg-warning">
                <div class="card-body text-center">
                    <h6>Inventario Total</h6>
                    <h2 class="fw-bold">{{ $inventarioTotal }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow border-0 rounded-4 text-white bg-danger">
                <div class="card-body text-center">
                    <h6>Stock Bajo</h6>
                    <h2 class="fw-bold">{{ $stockBajo }}</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- ACTIVIDAD SIMPLE (SIN TABLA) -->
    <div class="mt-5">

        <h4 class="mb-3">⚡ Actividad reciente</h4>

        <div class="row g-3">

            @forelse($actividad as $item)

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm rounded-4 p-3">

                        <!-- TIPO -->
                        <div class="mb-2">

                            @if($item['tipo'] === 'venta')
                                <span class="badge bg-primary">Venta</span>
                            @else
                                <span class="badge bg-warning text-dark">Servicio</span>
                            @endif

                        </div>

                        <!-- DETALLE -->
                        <div class="mb-2">

                            @if($item['tipo'] === 'venta')

                                @if(!empty($item['detalles']))
                                    @foreach($item['detalles'] as $detalle)

                                        <div class="small text-dark">

                                            • {{ $detalle->producto->nombre ?? 'Producto' }}

                                            @if(!empty($detalle->producto->marca->nombre))
                                                ({{ $detalle->producto->marca->nombre }})
                                            @endif

                                        </div>

                                    @endforeach
                                @else
                                    <span class="text-muted small">Sin detalles</span>
                                @endif

                            @else

                                <div class="small text-dark">

                                    {{ $item['categoria']->nombre ?? $item['nombre'] ?? 'Servicio' }}

                                </div>

                                <div class="small text-muted">

                                    ${{ $item['servicio']->precio ?? $item['total'] ?? 0 }}

                                </div>

                            @endif

                        </div>

                        <!-- FECHA + TOTAL -->
                        <div class="d-flex justify-content-between mt-2 small text-muted">

                            <span>📅 {{ $item['fecha'] ?? '-' }}</span>

                            <span class="fw-bold text-success">
                                ${{ $item['total'] ?? 0 }}
                            </span>

                        </div>

                    </div>

                </div>

            @empty

                <p class="text-muted">No hay actividad reciente</p>

            @endforelse

        </div>

    </div>

</div>

@endsection