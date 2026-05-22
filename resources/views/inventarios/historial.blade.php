@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Encabezado de la Vista -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <!-- Botón de regreso reubicado arriba para una mejor navegación -->
            <a href="{{ route('inventarios.index') }}" class="btn btn-sm btn-outline-secondary mb-2 fw-semibold px-3 shadow-sm border-2">
                <i class="bi bi-arrow-left-short"></i> Volver a Existencias
            </a>
            <h2 class="fw-bold text-dark mt-1 mb-1">Historial de Movimientos</h2>
            <p class="text-muted small mb-0">Listado detallado de todas las entradas individuales al inventario.</p>
        </div>
        
        <div class="d-flex align-items-center">
            <!-- Botón condicional para limpiar filtros si se busca un producto específico -->
            @if(request()->has('producto'))
                <a href="{{ route('inventarios.historial') }}" class="btn btn-outline-dark shadow-sm me-2 fw-semibold border-2">
                    <i class="bi bi-arrow-counterclockwise"></i> Mostrar Todo
                </a>
            @endif
            
            <!-- Botón para Registrar Nuevo Movimiento -->
            <a href="{{ route('inventarios.create') }}" class="btn btn-primary shadow fw-bold border-0 bg-gradient px-3">
                <i class="bi bi-box-seam-fill me-1"></i> + Nuevo Registro
            </a>
        </div>
    </div>

    <!-- Mensajes de Alerta (Éxito) -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <strong>¡Logrado!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Tabla del Historial Detallado -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4 py-3" style="width: 80px;">#</th>
                            <th class="py-3">Producto</th>
                            <th class="py-3">Precio Compra</th>
                            <th class="py-3 text-center">Cantidad</th>
                            <th class="py-3">Fecha de Registro</th>
                            <th class="text-end pe-4 py-3" style="width: 220px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($inventarios as $inv)
                        <tr>
                            <td class="ps-4 text-muted font-monospace">{{ $loop->iteration }}</td>

                            <!-- Información Completa del Producto usando Eloquent -->
                            <td class="fw-bold text-dark">
                                {{ $inv->productoCreado->producto->nombre ?? 'Sin producto' }}
                                <span class="text-secondary fw-normal">{{ $inv->productoCreado->marca->nombre ?? '' }}</span>
                                <span class="badge bg-light text-muted border font-normal fs-6 ms-1">{{ $inv->productoCreado->tipoProducto->nombre ?? '' }}</span>
                            </td>

                            <!-- Precio de Compra -->
                            <td class="text-success fw-semibold">
                                ${{ number_format($inv->precio_compra, 2) }}
                            </td>

                            <!-- Cantidad Individual -->
                            <td class="text-center fw-bold">
                                {{ $inv->cantidad }} pzas
                            </td>

                            <!-- Fecha -->
                            <td class="text-muted text-nowrap">
                                📅 {{ date('d/m/Y', strtotime($inv->fecha)) }}
                            </td>

                            <!-- Acciones de Edición y Eliminación Históricas -->
                            <td class="text-end pe-4">
                                <!-- Botón Editar con Fondo Suave Amarillo e Icono -->
                                <a href="{{ route('inventarios.edit', $inv->id_inventario) }}"
                                   class="btn btn-sm btn-warning bg-opacity-25 text-warning-emphasis fw-bold px-2.5 me-1 border-0 shadow-sm">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>

                                <!-- Botón Eliminar con Fondo Suave Rojo e Icono -->
                                <form action="{{ route('inventarios.destroy', $inv->id_inventario) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger bg-opacity-25 text-danger-emphasis fw-bold px-2.5 border-0 shadow-sm"
                                            onclick="return confirm('¿Seguro que deseas eliminar este registro específico del historial?')">
                                        <i class="bi bi-trash3-fill"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="mb-2 fs-3">📑</div>
                                <p class="mb-0 fw-semibold">No se encontraron movimientos individuales en el historial.</p>
                                @if(request()->has('producto'))
                                    <small class="text-muted">Este producto específico aún no registra entradas.</small>
                                @endif
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
