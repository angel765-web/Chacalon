@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-secondary">Catálogo Base de Artículos</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-primary shadow-sm">+ Nuevo Artículo</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Nombre del Artículo</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                <tr>
                    <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                    <td class="fw-bold">{{ $producto->nombre }}</td>
                    <td class="text-end pe-4">
                        <a href="{{ route('productos.edit', $producto->id_producto) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Borrar este artículo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-4 text-muted">No hay artículos base.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
