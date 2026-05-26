@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Agregar Nueva Calidad</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('calidades.store') }}"
                          method="POST"
                          onsubmit="return confirmarGuardado(event, this)">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tipo de calidad:</label>

                            <input type="text"
                                   name="nombre"
                                   class="form-control"
                                   required
                                   autofocus>
                        </div>

                        <div class="d-grid gap-2">

                            <button type="submit" class="btn btn-success">
                                Guardar
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

    // ✔ ALERTA DESPUÉS DE GUARDAR (cuando regresa del store)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Guardado',
            text: "{{ session('success') }}",
            confirmButtonColor: '#28a745'
        });
    @endif


    // ✔ CONFIRMAR GUARDADO (opcional pero profesional)
    function confirmarGuardado(event, form) {
        event.preventDefault();

        Swal.fire({
            title: "¿Guardar nueva calidad?",
            text: "Se registrará en el sistema",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sí, guardar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#28a745"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

</script>
@endsection