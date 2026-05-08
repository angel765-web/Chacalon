@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-secondary">Productos Creados</h2>
    <a href="{{ route('crear_productos.create') }}" class="btn btn-primary shadow-sm">+ Nuevo Producto</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Tipo</th>
                    <th>Calidad</th>
                    <th>Precio Venta</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $item)
                <tr>
                    <td class="ps-4 text-muted">{{ $loop->iteration }}</td>

                    <td class="fw-bold">{{ $item->producto->nombre }}</td>
                    <td>{{ $item->marca->nombre }}</td>
                    <td>{{ $item->tipoProducto->nombre }}</td>
                    <td>{{ $item->calidad->nombre }}</td>
                    <td>${{ $item->precio_venta }}</td>

                    <td class="text-end pe-4">
                        <a href="{{ route('crear_productos.edit', $item->id_crea_producto) }}"
                           class="btn btn-sm btn-outline-warning">Editar</a>

                        <form action="{{ route('crear_productos.destroy', $item->id_crea_producto) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('¿Eliminar este producto?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        No hay productos creados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection