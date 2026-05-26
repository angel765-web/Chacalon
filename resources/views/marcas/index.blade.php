@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

        <div>
            <h2 class="fw-bold mb-1">🏷️ Gestión de Marcas</h2>
            <p class="text-muted mb-0">
                Administración de marcas del catálogo
            </p>
        </div>

        <a href="{{ route('marcas.create') }}"
           class="btn btn-primary fw-semibold shadow-sm">
            + Nueva Marca
        </a>

    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            ✔ {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">#</th>
                            <th>Nombre de la marca</th>
                            <th class="text-end pe-3">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($marcas as $marca)

                            <tr>

                                <td class="ps-3 text-muted">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $marca->nombre }}
                                </td>

                                <td class="text-end pe-3">

                                    <a href="{{ route('marcas.edit', $marca->id_marca) }}"
                                       class="btn btn-sm btn-outline-warning fw-semibold">
                                        ✏️ Editar
                                    </a>

                                    <form id="formDelete{{ $marca->id_marca }}"
                                          action="{{ route('marcas.destroy', $marca->id_marca) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger fw-semibold"
                                                onclick="confirmDelete({{ $marca->id_marca }})">
                                            🗑 Eliminar
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <div class="fs-3 mb-2">🏷️</div>
                                    No hay marcas registradas
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
        title: "¿Eliminar marca?",
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