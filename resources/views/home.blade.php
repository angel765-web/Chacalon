@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- =====================================================
        HEADER
    ====================================================== -->
    <div class="p-4 p-md-5 mb-4 text-white rounded-4 shadow"
         style="background: linear-gradient(135deg,#1e3a8a,#2563eb);">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>
                <h1 class="fw-bold mb-1">📚 Papelería Mayliz</h1>
                <p class="mb-0 opacity-75">Panel operativo de ventas e inventario</p>
            </div>

            <div class="text-end mt-3 mt-md-0">
                <a href="{{ route('ventas.create') }}" class="btn btn-light fw-bold">
                    ➕ Nueva Venta
                </a>
            </div>

        </div>

    </div>

    <!-- =====================================================
        KPI SIMPLES (NO CARDS, SOLO INFO RÁPIDA)
    ====================================================== -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-lg-3">
            <div class="p-3 bg-white rounded-4 shadow-sm border">
                <div class="text-muted small">Ventas hoy</div>
                <div class="fs-4 fw-bold text-primary">{{ $ventasHoy }}</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="p-3 bg-white rounded-4 shadow-sm border">
                <div class="text-muted small">Ingresos hoy</div>
                <div class="fs-4 fw-bold text-success">
                    ${{ number_format($totalHoy, 2) }}
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="p-3 bg-white rounded-4 shadow-sm border">
                <div class="text-muted small">Inventario</div>
                <div class="fs-4 fw-bold text-dark">{{ $inventarioTotal }}</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="p-3 bg-white rounded-4 shadow-sm border">
                <div class="text-muted small">Stock crítico</div>
                <div class="fs-4 fw-bold text-danger">{{ $stockBajo }}</div>
            </div>
        </div>

    </div>

    <!-- =====================================================
        CUERPO PRINCIPAL
    ====================================================== -->
    <div class="row g-4">

        <!-- ================= ACTIVIDAD ================= -->
        <div class="col-lg-8">

            <div class="bg-white p-4 rounded-4 shadow-sm border">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">⚡ Actividad reciente</h5>
                </div>

                <div style="max-height: 500px; overflow-y: auto;">

                    @forelse($actividad as $item)

                        <div class="border-bottom py-3">

                            <!-- ENCABEZADO -->
                            <div class="d-flex justify-content-between align-items-center mb-1">

                                <div>
                                    @if($item['tipo'] === 'venta')
                                        <span class="badge bg-primary">VENTA</span>
                                    @else
                                        <span class="badge bg-warning text-dark">SERVICIO</span>
                                    @endif
                                </div>

                                <small class="text-muted">
                                    {{ $item['fecha'] ?? '-' }}
                                </small>

                            </div>

                            <!-- DETALLE -->
                            <div class="small">

                                @if($item['tipo'] === 'venta')

                                    @forelse($item['detalles'] ?? [] as $detalle)
                                        <div>
                                            • {{ $detalle->producto->nombre ?? 'Producto' }}
                                            @if(!empty($detalle->producto->marca->nombre))
                                                <span class="text-muted">
                                                    ({{ $detalle->producto->marca->nombre }})
                                                </span>
                                            @endif
                                        </div>
                                    @empty
                                        <span class="text-muted">Sin detalles</span>
                                    @endforelse

                                @else

                                    <div class="fw-semibold">
                                        {{ $item['categoria']->nombre ?? 'Servicio' }}
                                    </div>

                                    <div class="text-muted">
                                        Comisión: ${{ number_format($item['servicio']->comision ?? 0, 2) }}
                                    </div>

                                @endif

                            </div>

                            <!-- TOTAL -->
                            <div class="text-end mt-2">
                                <span class="fw-bold text-success">
                                    ${{ number_format($item['total'] ?? 0, 2) }}
                                </span>
                            </div>

                        </div>

                    @empty

                        <div class="text-center text-muted py-4">
                            No hay actividad reciente
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

        <!-- ================= ACCIONES RÁPIDAS ================= -->
        <div class="col-lg-4">

            <div class="bg-white p-4 rounded-4 shadow-sm border mb-4">

                <h5 class="mb-3">⚡ Acciones rápidas</h5>

                <a href="{{ route('ventas.create') }}" class="btn btn-primary w-100 mb-2">
                    ➕ Nueva Venta
                </a>

                <a href="/inventarios" class="btn btn-outline-dark w-100 mb-2">
                    📦 Inventario
                </a>

                <a href="/crear_productos" class="btn btn-outline-success w-100 mb-2">
                    🧾 Productos
                </a>

                <a href="/catalogo_servicios" class="btn btn-outline-warning w-100">
                    🛠 Servicios
                </a>

            </div>

            <div class="bg-white p-4 rounded-4 shadow-sm border">

                <h6 class="mb-3">⚠️ Alertas</h6>

                <div class="text-danger small">
                    • {{ $stockBajo }} productos con stock bajo
                </div>

            </div>

        </div>

    </div>

</div>

@endsection