@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">📦 Tipos y Estilos de Productos</h2>
            <p class="text-muted mb-0">Gestión de categorías como raya, cuadro, etc.</p>
        </div>

        <a href="{{ route('tipos.create') }}" class="btn btn-primary shadow-sm">
            + Nuevo Tipo
        </a>
    </div>

    <!-- ALERTA DE ÉXITO -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm border-0">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLA -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Tipo de Producto</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($tipos as $tipo)
                        <tr>
                            <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $tipo->nombre }}</td>

                            <td class="text-end pe-4">

                                <a href="{{ route('tipos.edit', $tipo->id_tipo_producto) }}"
                                   class="btn btn-sm btn-warning me-1">
                                    Editar
                                </a>

                                <form action="{{ route('tipos.destroy', $tipo->id_tipo_producto) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirmarEliminacion(event, this)">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>

                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                No hay tipos registrados
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

{{-- ================= SWEETALERT ================= --}}
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    // ALERTA DE ÉXITO (opcional pero recomendado)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: "{{ session('success') }}"
        });
    @endif


    // ALERTA DE ELIMINACIÓN
    function confirmarEliminacion(event, form) {
        event.preventDefault();

        Swal.fire({
            title: "¿Seguro?",
            text: "Este tipo será eliminado permanentemente",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }


   

</script>
@endsection