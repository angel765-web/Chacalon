@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4 p-4 text-white rounded-4 shadow"
         style="background: linear-gradient(135deg,#1e3a8a,#2563eb);">

        <h2 class="fw-bold mb-1">📦 Registrar Artículo Base</h2>
        <p class="mb-0 opacity-75">Agrega productos base al catálogo del sistema</p>

    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <form id="formProductoBase"
                          action="{{ route('productos.store') }}"
                          method="POST">

                        @csrf

                        <!-- NOMBRE -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                📘 Nombre del artículo
                            </label>

                            <input type="text"
                                   name="nombre"
                                   class="form-control form-control-lg @error('nombre') is-invalid @enderror"
                                   value="{{ old('nombre') }}"
                                   placeholder="Ej. Cartulina, Lápiz, Regla..."
                                   required
                                   autofocus>

                            <!-- 🔥 ERROR DE VALIDACIÓN -->
                            @error('nombre')
                                <div class="text-danger mt-2 small">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted">
                                Solo el nombre general, sin marca ni tipo.
                            </small>
                        </div>

                        <!-- BOTONES -->
                        <div class="d-flex justify-content-end gap-2 mt-4">

                            <a href="{{ route('productos.index') }}"
                               class="btn btn-outline-secondary">
                                Cancelar
                            </a>

                            <button type="button"
                                    id="btnGuardarArticulo"
                                    class="btn btn-success fw-semibold">
                                Guardar artículo
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
document.getElementById('btnGuardarArticulo').addEventListener('click', function () {

    Swal.fire({
        title: "¿Guardar artículo?",
        text: "Se agregará al catálogo base",
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

            document.getElementById('formProductoBase').submit();
        }

    });

});
</script>

@endsection