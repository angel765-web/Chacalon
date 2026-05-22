@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Encabezado Principal -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">Caja y Ventas del Día</h2>
            <p class="text-muted small mb-0">Monitoreo de ingresos comerciales y servicios prestados.</p>
        </div>
        
        <!-- Buscador por Fecha Indestructible (No usa Internet) -->
        <form action="{{ route('ventas.index') }}" method="GET" class="d-flex align-items-center gap-2">
            <label for="fecha_busqueda" class="form-label mb-0 fw-bold text-secondary text-nowrap small">Ver otro día:</label>
            <input type="date" 
                   id="fecha_busqueda" 
                   name="fecha_busqueda" 
                   value="{{ $fechaFiltro }}" 
                   class="form-control form-control-sm" 
                   onchange="this.form.submit()">
            
            @if($fechaFiltro !== now()->toDateString())
                <a href="{{ route('ventas.index') }}" class="btn btn-sm btn-outline-dark text-nowrap" title="Volver a hoy">
                    🔄 Hoy
                </a>
            @endif
        </form>

        <a href="{{ route('ventas.create') }}" class="btn btn-primary shadow fw-bold border-0 bg-gradient px-4">
            + Nueva Venta
        </a>
    </div>

    <!-- Alertas de Éxito -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <strong>¡Logrado!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Resumen Dinámico de Caja Diaria -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <span class="fs-4 text-success">💰</span>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small tracking-wider">Total de Caja ({{ date('d/m/Y', strtotime($fechaFiltro)) }})</h6>
                        <h4 class="fw-bold mb-0 text-dark">${{ number_format($ventas->sum('total'), 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <span class="fs-4 text-primary">🛒</span>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small tracking-wider">Notas Cobradas</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ $ventas->count() }} ventas</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Listado de las Ventas del Día -->
    @forelse($ventas as $venta)
        <div class="card shadow-sm mb-4 border-0 rounded-3 overflow-hidden">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3 px-4">
                <div>
                    <span class="badge bg-secondary px-2.5 py-1.5 me-2 fs-6 font-monospace">#{{ $venta->id_venta }}</span>
                    <span class="text-muted fw-semibold">📅 {{ date('H:i', strtotime($venta->fecha)) }} hrs</span>
                </div>
                <div>
                    <span class="text-muted small me-1">Monto Total:</span>
                    <span class="fs-4 fw-bold text-success">${{ number_format($venta->total, 2) }}</span>
                </div>
            </div>
            
            <div class="card-body p-4 bg-white">
                <div class="row g-4">
                    <!-- PRODUCTOS -->
                    <div class="col-md-6 border-end">
                        <h6 class="text-primary fw-bold mb-3">📦 Productos Entregados</h6>
                        <table class="table table-sm table-borderless align-middle mb-0">
                            <tbody>
                                @forelse($venta->detalles as $d)
                                <tr class="border-bottom-dashed">
                                    <td class="py-2">
                                        <span class="fw-bold text-dark">{{ $d->producto->producto->nombre ?? 'Sin nombre' }}</span>
                                        <small class="text-muted d-block">{{ $d->producto->marca->nombre ?? '' }}</small>
                                    </td>
                                    <td class="text-end py-2 text-nowrap">
                                        <span class="text-secondary small">${{ number_format($d->producto->precio_venta, 2) }}</span>
                                        <span class="badge bg-light text-dark border ms-2">x{{ $d->cantidad }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td class="text-muted py-2 small italic">No incluye artículos.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- SERVICIOS -->
                    <div class="col-md-6">
                        <h6 class="text-success fw-bold mb-3">🧾 Servicios Prestados</h6>
                        <table class="table table-sm table-borderless align-middle mb-0">
                            <tbody>
                                @forelse($venta->servicios as $s)
                                <tr class="border-bottom-dashed">
                                    <td class="py-2">
                                        <span class="fw-semibold text-dark">{{ $s->categoria->nombre ?? 'Servicio' }}</span>
                                        @if($s->comision > 0)
                                            <small class="text-warning-emphasis d-block fw-medium">⚙️ Comisión: ${{ number_format($s->comision, 2) }}</small>
                                        @endif
                                    </td>
                                    <td class="text-end py-2 fw-bold text-success text-nowrap">${{ number_format($s->monto + $s->comision, 2) }}</td>
                                </tr>
                                @empty
                                <tr><td class="text-muted py-2 small italic">No incluye servicios.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card shadow-sm border-0 bg-white p-5 text-center text-muted rounded-3">
            <div class="fs-2 mb-2">☕</div>
            <h5 class="fw-bold mb-1 text-dark">Sin registros para esta fecha</h5>
            <small>No se encontraron movimientos comerciales el {{ date('d/m/Y', strtotime($fechaFiltro)) }}.</small>
        </div>
    @endforelse

</div>

<style>
    .border-bottom-dashed { border-bottom: 1px dashed #dee2e6 !important; }
</style>
@endsection
