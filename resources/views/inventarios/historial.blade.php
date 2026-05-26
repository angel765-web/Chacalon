@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Encabezado de la Vista -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('inventarios.index') }}" class="btn btn-sm btn-outline-secondary mb-2 fw-semibold px-3 shadow-sm border-2">
                <i class="bi bi-arrow-left-short"></i> Volver a Existencias
            </a>

            <h2 class="fw-bold text-dark mt-1 mb-1">Historial de Movimientos</h2>
            <p class="text-muted small mb-0">Listado detallado de todas las entradas individuales al inventario.</p>
        </div>

        <div class="d-flex align-items-center">

            @if(request()->has('producto'))
                <a href="{{ route('inventarios.historial') }}" class="btn btn-outline-dark shadow-sm me-2 fw-semibold border-2">
                    <i class="bi bi-arrow-counterclockwise"></i> Mostrar Todo
                </a>
            @endif

            <a href="{{ route('inventarios.create') }}" class="btn btn-primary shadow fw-bold border-0 bg-gradient px-3">
                <i class="bi bi-box-seam-fill me-1"></i> + Nuevo Registro
            </a>
        </div>
    </div>

    <!-- TABLA -->
    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4 py-3">#</th>
                            <th>Producto</th>
                            <th>Precio Compra</th>
                            <th class="text-center">Cantidad</th>
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
                                <span class="text-secondary fw-normal">
                                    {{ $inv->productoCreado->marca->nombre ?? '' }}
                                </span>
                            </td>

                            <td class="text-success fw-semibold">
                                ${{ number_format($inv->precio_compra, 2) }}
                            </td>

                            <td class="text-center fw-bold">
                                {{ $inv->cantidad }} pzas
                            </td>

                            <td class="text-muted">
                                📅 {{ date('d/m/Y', strtotime($inv->fecha)) }}
                            </td>

                            <td class="text-end pe-4">

                                <a href="{{ route('inventarios.edit', $inv->id_inventario) }}"
                                   class="btn btn-sm btn-warning me-1">
                                    Editar
                                </a>

                                <form action="{{ route('inventarios.destroy', $inv->id_inventario) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirmarEliminacion(event, this)">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>

                                </form>

                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                No hay movimientos registrados
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

    // ALERTA DE ÉXITO (create / update / delete)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: "{{ session('success') }}"
        });
    @endif


    // CONFIRMACIÓN ELIMINAR
    function confirmarEliminacion(event, form) {
        event.preventDefault();

        Swal.fire({
            title: "¿Seguro que deseas eliminar?",
            text: "Este registro se eliminará permanentemente",
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