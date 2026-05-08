@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-secondary">Gestión de Calidades</h2>
    <a href="{{ route('calidades.create') }}" class="btn btn-primary shadow-sm">+ Nueva Calidad</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Nombre de la Calidad</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($calidades as $calidad)
                <tr>
                    <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                    <td class="fw-bold">{{ $calidad->nombre }}</td>
                    <td class="text-end pe-4">
                        <a href="{{ route('calidades.edit', $calidad->id_calidad) }}" class="btn btn-sm btn-outline-warning me-2">Editar</a>
                        <form action="{{ route('calidades.destroy', $calidad->id_calidad) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar esta calidad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-4 text-muted">No hay registros.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
