@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4 p-4 text-white rounded-4 shadow"
         style="background: linear-gradient(135deg,#1e3a8a,#2563eb);">

        <h2 class="fw-bold mb-1">🏷️ Nueva Marca</h2>
        <p class="mb-0 opacity-75">Registra una nueva marca en el sistema</p>

    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <form id="formCrearMarca" action="{{ route('marcas.store') }}" method="POST">
                        @csrf

                        <!-- NOMBRE -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                🏷️ Nombre de la marca
                            </label>

                            <input type="text"
                                   name="nombre"
                                   class="form-control form-control-lg"
                                   placeholder="Ej. Bic, Pilot, Maped..."
                                   required
                                   autofocus>
                        </div>

                        <!-- BOTONES -->
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('marcas.index') }}"
                               class="btn btn-outline-secondary">
                                Cancelar
                            </a>

                            <button type="button"
                                    id="btnGuardarMarca"
                                    class="btn btn-success fw-semibold">
                                Guardar marca
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('btnGuardarMarca').addEventListener('click', function () {

    Swal.fire({
        title: "¿Guardar marca?",
        text: "Se agregará al catálogo de marcas",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#198754",
        cancelButtonColor: "#6c757d"
    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                icon: "success",
                title: "Guardando...",
                showConfirmButton: false,
                timer: 800
            });

            document.getElementById('formCrearMarca').submit();
        }

    });

});
</script>

@endsection