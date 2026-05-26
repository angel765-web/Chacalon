@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4 p-4 text-white rounded-4 shadow"
         style="background: linear-gradient(135deg,#f59e0b,#d97706);">

        <h2 class="fw-bold mb-1">✏️ Editar Producto</h2>
        <p class="mb-0 opacity-75">Actualiza la información del producto</p>

    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <form id="formEditarProducto"
                          action="{{ route('crear_productos.update', $crear->id_crea_producto) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <!-- PRODUCTO -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📘 Producto</label>
                            <select name="id_producto" class="form-select" required>
                                @foreach($productos as $p)
                                    <option value="{{ $p->id_producto }}"
                                        {{ $crear->id_producto == $p->id_producto ? 'selected' : '' }}>
                                        {{ $p->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- MARCA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">🏷 Marca</label>
                            <select name="id_marca" class="form-select" required>
                                @foreach($marcas as $m)
                                    <option value="{{ $m->id_marca }}"
                                        {{ $crear->id_marca == $m->id_marca ? 'selected' : '' }}>
                                        {{ $m->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- TIPO -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📂 Tipo</label>
                            <select name="id_tipo_producto" class="form-select" required>
                                @foreach($tipos as $t)
                                    <option value="{{ $t->id_tipo_producto }}"
                                        {{ $crear->id_tipo_producto == $t->id_tipo_producto ? 'selected' : '' }}>
                                        {{ $t->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- CALIDAD -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">⭐ Calidad</label>
                            <select name="id_calidad" class="form-select" required>
                                @foreach($calidades as $c)
                                    <option value="{{ $c->id_calidad }}"
                                        {{ $crear->id_calidad == $c->id_calidad ? 'selected' : '' }}>
                                        {{ $c->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- PRECIO -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">💰 Precio de venta</label>
                            <input type="number"
                                   step="0.01"
                                   name="precio_venta"
                                   value="{{ $crear->precio_venta }}"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- BOTONES -->
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('crear_productos.index') }}"
                               class="btn btn-outline-secondary">
                                Cancelar
                            </a>

                            <button type="button"
                                    id="btnActualizarProducto"
                                    class="btn btn-warning fw-semibold">
                                Actualizar
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
document.getElementById('btnActualizarProducto').addEventListener('click', function () {

    Swal.fire({
        title: "¿Actualizar producto?",
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
                timer: 900
            });

            document.getElementById('formEditarProducto').submit();
        }

    });

});
</script>

@endsection