@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-secondary">Gestión de Marcas</h2>
    <!-- LÓGICA: Ahora es un enlace real que apunta a tu vista 'create' -->
    <a href="{{ route('marcas.create') }}" class="btn btn-primary shadow-sm">
        + Nueva Marca
    </a>
</div>

<!-- Mensaje de éxito (Opcional pero recomendado) -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4">numero</th>
                    <th>Nombre de la Marca</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($marcas as $marca)
                <tr>
                    <td class="ps-4">{{ $loop->iteration }}</td>
                    <td class="fw-bold">{{ $marca->nombre }}</td>
                    <td class="text-end pe-4">
                        <!-- LÓGICA: Enlace para ir a la vista 'edit' con el ID correspondiente -->
                        <a href="{{ route('marcas.edit', $marca->id_marca) }}" class="btn btn-sm btn-outline-warning me-2">
                            Editar
                        </a>

                        <!-- LÓGICA: El botón de eliminar DEBE ser un formulario por seguridad en Laravel -->
                        <form action="{{ route('marcas.destroy', $marca->id_marca) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de eliminar esta marca?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">No hay marcas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
