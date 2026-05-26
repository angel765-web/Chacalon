@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-warning">
                    <h4 class="mb-0">Editar Tipo de Servicio</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('catalogo_servicios.update', $categoria->id_categoria_servicio) }}"
                          method="POST"
                          onsubmit="return confirmarActualizacion(event, this)">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre del Servicio:</label>

                            <input type="text"
                                   name="nombre"
                                   value="{{ $categoria->nombre }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="d-grid gap-2">

                            <button type="submit" class="btn btn-primary">
                                Actualizar Cambios
                            </button>

                            <a href="{{ route('catalogo_servicios.index') }}"
                               class="btn btn-secondary">
                                Cancelar
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection


{{-- ================= SWEETALERT ================= --}}
@section('scripts')
<script>

    // ✔ ALERTA DE ÉXITO (cuando regresa del update)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Actualizado',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6'
        });
    @endif


    // ✔ CONFIRMAR ACTUALIZACIÓN
    function confirmarActualizacion(event, form) {
        event.preventDefault();

        Swal.fire({
            title: "¿Actualizar servicio?",
            text: "Se guardarán los cambios realizados",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sí, actualizar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#3085d6"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

</script>
@endsection