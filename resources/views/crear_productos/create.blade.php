@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4 p-4 text-white rounded-4 shadow"
         style="background: linear-gradient(135deg,#1e3a8a,#2563eb);">

        <h2 class="fw-bold mb-1">📦 Crear Producto</h2>
        <p class="mb-0 opacity-75">Configura un nuevo producto en el sistema</p>

    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <form id="formCrearProducto" action="{{ route('crear_productos.store') }}" method="POST">
                        @csrf

                        <!-- PRODUCTO -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📘 Producto</label>
                            <select name="id_producto" class="form-select" required>
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $p)
                                    <option value="{{ $p->id_producto }}">
                                        {{ $p->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- MARCA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">🏷 Marca</label>
                            <select name="id_marca" class="form-select" required>
                                <option value="">Seleccione una marca</option>
                                @foreach($marcas as $m)
                                    <option value="{{ $m->id_marca }}">
                                        {{ $m->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- TIPO -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📂 Tipo de producto</label>
                            <select name="id_tipo_producto" class="form-select" required>
                                <option value="">Seleccione tipo</option>
                                @foreach($tipos as $t)
                                    <option value="{{ $t->id_tipo_producto }}">
                                        {{ $t->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- CALIDAD -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">⭐ Calidad</label>
                            <select name="id_calidad" class="form-select" required>
                                <option value="">Seleccione calidad</option>
                                @foreach($calidades as $c)
                                    <option value="{{ $c->id_calidad }}">
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
                                   class="form-control"
                                   placeholder="Ej. 25.50"
                                   required>
                        </div>

                        <!-- BOTONES -->
                        <div class="d-flex gap-2 justify-content-end">

                            <a href="{{ route('crear_productos.index') }}"
                               class="btn btn-outline-secondary">
                                Cancelar
                            </a>

                            <button type="button" id="btnGuardarProducto"
                                    class="btn btn-success fw-semibold">
                                Guardar Producto
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
document.getElementById('btnGuardarProducto').addEventListener('click', function () {

    Swal.fire({
        title: "¿Guardar producto?",
        text: "Se registrará en el catálogo",
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
                timer: 900
            });

            document.getElementById('formCrearProducto').submit();
        }

    });

});
</script>

@endsection