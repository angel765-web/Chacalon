@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-secondary">Inventario</h2>
    <a href="{{ route('inventarios.create') }}" class="btn btn-primary shadow-sm">+ Nuevo Registro</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Producto</th>
                    <th>Precio Compra</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($inventarios as $inv)
                <tr>
                    <td class="ps-4 text-muted">{{ $loop->iteration }}</td>

                    <td class="fw-bold">
                        {{ $inv->productoCreado->producto->nombre ?? 'Sin producto' }}
                        {{ $inv->productoCreado->marca->nombre ?? '' }}
                        {{ $inv->productoCreado->tipoProducto->nombre ?? '' }}
                    </td>

                    <td>${{ $inv->precio_compra }}</td>
                    <td>{{ $inv->cantidad }}</td>
                    <td>{{ $inv->fecha }}</td>

                    <td class="text-end pe-4">
                        <a href="{{ route('inventarios.edit', $inv->id_inventario) }}"
                           class="btn btn-sm btn-outline-warning">Editar</a>

                        <form action="{{ route('inventarios.destroy', $inv->id_inventario) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('¿Eliminar registro?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                        No hay registros en inventario.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection