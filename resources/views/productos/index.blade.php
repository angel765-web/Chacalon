@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

        <div>
            <h2 class="fw-bold mb-1">📚 Catálogo Base de Artículos</h2>
            <p class="text-muted mb-0">
                Administración de productos principales del sistema
            </p>
        </div>

        <a href="{{ route('productos.create') }}"
           class="btn btn-primary fw-semibold shadow-sm">
            + Nuevo Artículo
        </a>

    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            <strong>✔ Éxito:</strong> {{ session('success') }}
        </div>
    @endif

    <!-- STATS -->
    <div class="row g-3 mb-4">

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body d-flex align-items-center gap-3">

                    <div class="fs-3">🏷️</div>

                    <div>
                        <small class="text-muted">Total artículos</small>
                        <h4 class="mb-0 fw-bold">{{ $productos->count() }}</h4>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- TABLE -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">#</th>
                            <th>Nombre del artículo</th>
                            <th class="text-end pe-3">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($productos as $producto)

                            <tr>

                                <td class="ps-3 text-muted">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $producto->nombre }}
                                </td>

                                <td class="text-end pe-3">

                                    <a href="{{ route('productos.edit', $producto->id_producto) }}"
                                       class="btn btn-sm btn-outline-warning fw-semibold">
                                        ✏️ Editar
                                    </a>

                                    <form id="formDelete{{ $producto->id_producto }}"
                                          action="{{ route('productos.destroy', $producto->id_producto) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger fw-semibold"
                                                onclick="confirmDelete({{ $producto->id_producto }})">
                                            🗑 Eliminar
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <div class="fs-3 mb-2">📁</div>
                                    No hay artículos base registrados
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
        title: "¿Eliminar artículo?",
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