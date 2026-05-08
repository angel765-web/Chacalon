@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-secondary">Tipos y Estilos de Productos</h2>
    <a href="{{ route('tipos.create') }}" class="btn btn-primary shadow-sm">+ Nuevo Tipo</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Descripción del Tipo (Raya, Cuadro, etc.)</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tipos as $tipo)
                <tr>
                    <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                    <td class="fw-bold">{{ $tipo->nombre }}</td>
                    <td class="text-end pe-4">
                        <a href="{{ route('tipos.edit', $tipo->id_tipo_producto) }}" class="btn btn-sm btn-outline-warning me-2">Editar</a>
                        <form action="{{ route('tipos.destroy', $tipo->id_tipo_producto) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar este tipo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-4 text-muted">No hay tipos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
