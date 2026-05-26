@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4 p-4 text-white rounded-4 shadow"
         style="background: linear-gradient(135deg,#f59e0b,#d97706);">

        <h2 class="fw-bold mb-1">✏️ Editar Artículo Base</h2>
        <p class="mb-0 opacity-75">Modifica la información del producto base</p>

    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <form id="formEditarArticulo"
                          action="{{ route('productos.update', $producto->id_producto) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <!-- NOMBRE -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                ✏️ Nombre del artículo
                            </label>

                            <input type="text"
                                   name="nombre"
                                   value="{{ $producto->nombre }}"
                                   class="form-control form-control-lg"
                                   required>
                        </div>

                        <!-- BOTONES -->
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('productos.index') }}"
                               class="btn btn-outline-secondary">
                                Cancelar
                            </a>

                            <button type="button"
                                    id="btnActualizarArticulo"
                                    class="btn btn-warning fw-semibold">
                                Actualizar cambios
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
document.getElementById('btnActualizarArticulo').addEventListener('click', function () {

    Swal.fire({
        title: "¿Actualizar artículo?",
        text: "Se guardarán los cambios realizados",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, actualizar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#f59e0b",
        cancelButtonColor: "#6c757d"
    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                icon: "success",
                title: "Actualizando...",
                showConfirmButton: false,
                timer: 800
            });

            document.getElementById('formEditarArticulo').submit();
        }

    });

});
</script>

@endsection