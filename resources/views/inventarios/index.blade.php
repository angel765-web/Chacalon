@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Encabezado de la Vista -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Existencias en Inventario</h2>
            <p class="text-muted small mb-0">Monitoreo de stock actual disponible en almacén.</p>
        </div>
        <div>
            <!-- Enlace a la nueva vista que crearemos para el historial -->
            <a href="{{ route('inventarios.historial') }}" class="btn btn-outline-secondary shadow-sm me-2">
                <i class="bi bi-clock-history"></i> Ver Historial Completo
            </a>
            <a href="{{ route('inventarios.create') }}" class="btn btn-primary shadow-sm fw-bold">
                + Nuevo Registro
            </a>
        </div>
    </div>

    <!-- Tarjetas de Información Rápida (Kpi's) -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <span class="fs-4 text-primary">📦</span>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small tracking-wider">Productos Únicos</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ $existencias->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Tabla de Existencias Agrupadas -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4 py-3" style="width: 80px;">#</th>
                            <th class="py-3">Descripción del Producto</th>
                            <th class="py-3">Categoría / Tipo</th>
                            <th class="py-3">Marca</th>
                            <th class="py-3 text-center" style="width: 180px;">Stock Disponible</th>
                            <th class="text-end pe-4 py-3" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($existencias as $inv)
                        <tr>
                            <td class="ps-4 text-muted font-monospace">{{ $loop->iteration }}</td>

                            <!-- Nombre del Producto -->
                            <td>
                                <span class="fw-bold text-dark">{{ $inv->producto_nombre }}</span>
                            </td>

                            <!-- Tipo de Producto -->
                            <td>
                                <span class="badge bg-light text-secondary border px-2.5 py-1.5">{{ $inv->tipo_nombre }}</span>
                            </td>

                            <!-- Marca -->
                            <td>
                                <span class="text-secondary">{{ $inv->marca_nombre }}</span>
                            </td>

                            <!-- Cantidad con semáforo de color dinámico -->
                            <td class="text-center">
                                @if($inv->total_cantidad <= 0)
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-bold w-100">
                                        Agotado (0)
                                    </span>
                                @elseif($inv->total_cantidad <= 5)
                                    <span class="badge bg-warning bg-opacity-10 text-warning-emphasis border border-warning-subtle px-3 py-2 rounded-pill fw-bold w-100">
                                        Bajo Stock ({{ $inv->total_cantidad }})
                                    </span>
                                @else
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-2 rounded-pill fw-bold w-100">
                                        {{ $inv->total_cantidad }} unidades
                                    </span>
                                @endif
                            </td>

                            <!-- Botón de Acción -->
                            <td class="text-end pe-4">
                                <a href="{{ route('inventarios.historial', ['producto' => $inv->id_crea_producto]) }}" 
                                   class="btn btn-sm btn-outline-primary fw-semibold px-3 shadow-xs">
                                    Ver Detalle
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="mb-2 fs-3">📥</div>
                                <p class="mb-0 fw-semibold">No hay existencias registradas en el inventario.</p>
                                <small class="text-muted">Crea un nuevo registro para comenzar a ver el stock.</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
