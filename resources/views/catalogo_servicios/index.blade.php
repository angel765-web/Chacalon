@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-secondary">Catálogo de Servicios Extras</h2>

    <a href="{{ route('catalogo_servicios.create') }}"
       class="btn btn-primary shadow-sm">
        + Nuevo Servicio
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">

        <table class="table table-hover mb-0">

            <thead class="table-dark">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Nombre del Servicio (Copias, Internet, etc.)</th>
                    <th class="text-end pe-4">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categorias as $categoria)
                <tr>

                    <td class="ps-4 text-muted">
                        {{ $loop->iteration }}
                    </td>

                    <td class="fw-bold">
                        {{ $categoria->nombre }}
                    </td>

                    <td class="text-end pe-4">

                        <a href="{{ route('catalogo_servicios.edit', $categoria->id_categoria_servicio) }}"
                           class="btn btn-sm btn-outline-warning">
                            Editar
                        </a>

                        <form action="{{ route('catalogo_servicios.destroy', $categoria->id_categoria_servicio) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirmarEliminacion(event, this)">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">
                        No hay servicios registrados.
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection


{{-- ================= SWEETALERT ================= --}}
@section('scripts')
<script>

    // ✔ ALERTA DE ÉXITO GLOBAL
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6'
        });
    @endif


    // ✔ CONFIRMACIÓN DE ELIMINACIÓN
    function confirmarEliminacion(event, form) {
        event.preventDefault();

        Swal.fire({
            title: "¿Eliminar este servicio?",
            text: "Esta acción no se podrá deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#d33"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

</script>
@endsection