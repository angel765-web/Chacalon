@extends('layouts.app')

@section('content')
<div class="container-fluid py-4" style="font-family: system-ui, -apple-system, sans-serif;">

    <!-- Encabezado Principal -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1" style="color: #212529; font-weight: 700;">Caja y Ventas del Día</h2>
            <p class="text-muted small mb-0" style="color: #6c757d; font-size: 0.875rem;">Monitoreo de ingresos comerciales y servicios prestados.</p>
        </div>
        
        <!-- Buscador por Fecha -->
        <form action="{{ route('ventas.index') }}" method="GET" class="d-flex align-items-center gap-2">
            <label for="fecha_busqueda" class="form-label mb-0 fw-bold text-secondary text-nowrap small" style="color: #495057; font-size: 0.875rem; font-weight: 600;">Ver otro día:</label>
            <input type="date" 
                   id="fecha_busqueda" 
                   name="fecha_busqueda" 
                   value="{{ $fechaFiltro }}" 
                   class="form-control form-control-sm shadow-sm" 
                   style="border: 1px solid #ced4da; border-radius: 0.375rem; padding: 0.25rem 0.5rem;"
                   onchange="this.form.submit()">
            
            @if($fechaFiltro !== now()->toDateString())
                <a href="{{ route('ventas.index') }}" class="btn btn-sm btn-outline-dark text-nowrap shadow-sm" style="border: 1px solid #212529; border-radius: 0.375rem; text-decoration: none; color: #212529; padding: 0.25rem 0.5rem;" title="Volver a hoy">
                    🔄 Hoy
                </a>
            @endif
        </form>

        <a href="{{ route('ventas.create') }}" class="btn btn-primary shadow fw-bold border-0 bg-gradient px-4" style="background-color: #0d6efd; color: white; border-radius: 0.375rem; text-decoration: none; padding: 0.5rem 1rem; font-weight: bold;">
            + Nueva Venta
        </a>
    </div>

    <!-- Alertas de Éxito -->
    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4" role="alert" style="background-color: #d1e7dd; color: #0f5132; padding: 1rem; border-radius: 0.375rem;">
        <strong>¡Logrado!</strong> {{ session('success') }}
    </div>
    @endif

    <!-- Resumen Dinámico de Caja Diaria -->
    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 250px;">
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075); padding: 1rem; border: 1px solid #efefef;">
                <div style="display: flex; align-items: center;">
                    <div style="background: rgba(25,135,84,0.1); padding: 0.75rem; border-radius: 50%; margin-right: 1rem;">
                        <span style="font-size: 1.5rem;">💰</span>
                    </div>
                    <div>
                        <h6 style="color: #6c757d; margin: 0; font-size: 0.75rem; text-transform: uppercase;">Total de Caja ({{ date('d/m/Y', strtotime($fechaFiltro)) }})</h6>
                        <h4 style="color: #198754; margin: 0; font-size: 1.5rem; font-weight: bold;">${{ number_format($ventas->sum('total'), 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div style="flex: 1; min-width: 250px;">
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075); padding: 1rem; border: 1px solid #efefef;">
                <div style="display: flex; align-items: center;">
                    <div style="background: rgba(13,110,253,0.1); padding: 0.75rem; border-radius: 50%; margin-right: 1rem;">
                        <span style="font-size: 1.5rem;">🛒</span>
                    </div>
                    <div>
                        <h6 style="color: #6c757d; margin: 0; font-size: 0.75rem; text-transform: uppercase;">Notas Cobradas</h6>
                        <h4 style="color: #212529; margin: 0; font-size: 1.5rem; font-weight: bold;">{{ $ventas->count() }} ventas</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Listado de las Ventas del Día -->
    @forelse($ventas as $venta)
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075); margin-bottom: 1.5rem; overflow: hidden; border: 1px solid #e0e0e0;">
            <div style="background: #f8f9fa; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1.25rem;">
                <div>
                    <span style="background: #6c757d; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-family: monospace;">#{{ $venta->id_venta }}</span>
                    <span style="color: #6c757d; font-weight: 600;">📅 {{ date('H:i', strtotime($venta->fecha)) }} hrs</span>
                </div>
                <div>
                    <span style="color: #6c757d; font-size: 0.875rem;">Monto Total:</span>
                    <span style="color: #198754; font-size: 1.5rem; font-weight: bold;">${{ number_format($venta->total, 2) }}</span>
                </div>
            </div>
            
            <div style="padding: 1.25rem;">
                <div style="display: flex; flex-wrap: wrap; gap: 1.5rem;">
                    
                    <!-- COLUMNA DE PRODUCTOS -->
                    <div style="flex: 1; min-width: 280px; border-right: 2px solid #f0f0f0; padding-right: 1rem;">
                        <h6 style="color: #0d6efd; font-weight: bold; margin-top: 0; margin-bottom: 1rem;">📦 Productos Entregados</h6>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tbody>
                                @forelse($venta->detalles as $d)
                                <tr style="border-bottom: 1px dashed #dee2e6;">
                                    <td style="padding: 0.5rem 0;">
                                        <span style="font-weight: bold; color: #212529;">{{ $d->producto->producto->nombre ?? 'Sin nombre' }}</span>
                                        <small style="color: #6c757d; display: block;">{{ $d->producto->marca->nombre ?? '' }}</small>
                                    </td>
                                    <td style="text-align: right; padding: 0.5rem 0; white-space: nowrap;">
                                        <span style="color: #6c757d; font-size: 0.875rem;">${{ number_format($d->producto->precio_venta, 2) }}</span>
                                        <span style="background: #f8f9fa; color: #212529; border: 1px solid #dee2e6; padding: 0.15rem 0.3rem; border-radius: 0.25rem; margin-left: 0.5rem;">x{{ $d->cantidad }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td style="color: #6c757d; font-style: italic; padding: 0.5rem 0;">No incluye artículos.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- COLUMNA DE SERVICIOS -->
                    <div style="flex: 1; min-width: 280px;">
                        <h6 style="color: #198754; font-weight: bold; margin-top: 0; margin-bottom: 1rem;">🧾 Servicios Prestados</h6>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tbody>
                                @forelse($venta->servicios as $s)
                                <tr style="border-bottom: 1px dashed #dee2e6;">
                                    <td style="padding: 0.5rem 0;">
                                        <span style="font-weight: 600; color: #212529;">{{ $s->categoria->nombre ?? 'Servicio' }}</span>
                                        @if($s->comision > 0)
                                            <small style="color: #664d03; display: block; font-weight: 500;">⚙️ Comisión: ${{ number_format($s->comision, 2) }}</small>
                                        @endif
                                    </td>
                                    <td style="text-align: right; padding: 0.5rem 0; font-weight: bold; color: #198754; white-space: nowrap;">
                                        ${{ number_format($s->monto + $s->comision, 2) }}
                                    </td>
                                </tr>
                                @empty
                                <tr><td style="color: #6c757d; font-style: italic; padding: 0.5rem 0;">No incluye servicios.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    @empty
        <!-- Estado Vacío Global -->
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075); padding: 3rem; text-center; color: #6c757d; border: 1px solid #dee2e6;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">☕</div>
            <h5 style="font-weight: bold; color: #212529; margin-bottom: 0.25rem;">Sin registros para esta fecha</h5>
            <small>No se encontraron movimientos comerciales el {{ date('d/m/Y', strtotime($fechaFiltro)) }}.</small>
        </div>
    @endforelse

</div>
@endsection
