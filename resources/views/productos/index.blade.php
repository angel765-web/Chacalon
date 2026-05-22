@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Encabezado de la Vista -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Catálogo Base de Artículos</h2>
            <p class="text-muted small mb-0">Administración de nombres y conceptos de productos principales.</p>
        </div>
        <div>
            <!-- Botón Nuevo Artículo Estilizado -->
            <a href="{{ route('productos.create') }}" class="btn btn-primary shadow fw-bold border-0 bg-gradient px-3">
                <i class="bi bi-plus-circle-fill me-1"></i> + Nuevo Artículo
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

    <!-- Tarjeta de Estadísticas Rápida -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <span class="fs-4 text-primary">🏷️</span>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small tracking-wider">Artículos Registrados</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ $productos->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Artículos Base -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4 py-3" style="width: 80px;">#</th>
                            <th class="py-3">Nombre del Artículo</th>
                            <th class="text-end pe-4 py-3" style="width: 220px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($productos as $producto)
                        <tr>
                            <td class="ps-4 text-muted font-monospace">{{ $loop->iteration }}</td>

                            <!-- Nombre del Artículo -->
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $producto->nombre }}</span>
                            </td>

                            <!-- Botones de Acción Estilizados -->
                            <td class="text-end pe-4">
                                <!-- Botón Editar con Fondo Suave Amarillo -->
                                <a href="{{ route('productos.edit', $producto->id_producto) }}" 
                                   class="btn btn-sm btn-warning bg-opacity-25 text-warning-emphasis fw-bold px-2.5 me-1 border-0 shadow-sm">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>

                                <!-- Botón Eliminar con Fondo Suave Rojo -->
                                <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" class="d-inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger bg-opacity-25 text-danger-emphasis fw-bold px-2.5 border-0 shadow-sm" 
                                            onclick="return confirm('¿Seguro que deseas eliminar este artículo base por completo?')">
                                        <i class="bi bi-trash3-fill"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <div class="mb-2 fs-3">📁</div>
                                <p class="mb-0 fw-semibold">No hay artículos base registrados.</p>
                                <small class="text-muted">Presiona "+ Nuevo Artículo" para añadir el primero.</small>
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
