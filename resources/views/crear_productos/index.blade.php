@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        <div>
            <h2 class="fw-bold mb-1">📦 Productos Creados</h2>
            <small class="text-muted">Listado general de productos del sistema</small>
        </div>

        <a href="{{ route('crear_productos.create') }}"
           class="btn btn-primary shadow-sm fw-semibold">
            + Nuevo Producto
        </a>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">#</th>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Tipo</th>
                            <th>Calidad</th>
                            <th>Precio</th>
                            <th class="text-end pe-3">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($productos as $item)

                            <tr>

                                <td class="ps-3 text-muted">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $item->producto->nombre }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $item->marca->nombre }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->tipoProducto->nombre }}
                                </td>

                                <td>
                                    {{ $item->calidad->nombre }}
                                </td>

                                <td class="fw-bold text-success">
                                    ${{ number_format($item->precio_venta, 2) }}
                                </td>

                                <td class="text-end pe-3">

                                    <a href="{{ route('crear_productos.edit', $item->id_crea_producto) }}"
                                       class="btn btn-sm btn-outline-warning fw-semibold">
                                        Editar
                                    </a>

                                    <form id="formDelete{{ $item->id_crea_producto }}"
                                          action="{{ route('crear_productos.destroy', $item->id_crea_producto) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger fw-semibold"
                                                onclick="confirmDelete({{ $item->id_crea_producto }})">
                                            Eliminar
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    No hay productos creados aún.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {

    Swal.fire({
        title: "¿Eliminar producto?",
        text: "Esta acción no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {

        if (result.isConfirmed) {
            document.getElementById('formDelete' + id).submit();
        }

    });

}
</script>

@endsection