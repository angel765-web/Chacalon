@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-warning">
                    <h4 class="mb-0">Editar Calidad</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('calidades.update', $calidad->id_calidad) }}"
                          method="POST"
                          onsubmit="return confirmarActualizacion(event, this)">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Tipo de Calidad:</label>

                            <input type="text"
                                   name="nombre"
                                   value="{{ $calidad->nombre }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="d-grid gap-2">

                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>

                            <a href="{{ route('calidades.index') }}"
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


    // ✔ CONFIRMAR ACTUALIZACIÓN (opcional pero profesional)
    function confirmarActualizacion(event, form) {
        event.preventDefault();

        Swal.fire({
            title: "¿Actualizar calidad?",
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