@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="card border-0 shadow-lg rounded-4">

                {{-- ENCABEZADO --}}
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-0 fw-bold">
                                Registrar Inventario
                            </h4>
                            <small>Capture la información del producto a ingresar</small>
                        </div>

                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center"
                             style="width: 48px; height: 48px;">
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                    </div>
                </div>

                {{-- CUERPO --}}
                <div class="card-body p-4">

                    {{-- ERRORES --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Verifique la información capturada:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="formInventario"
                          action="{{ route('inventarios.store') }}"
                          method="POST">
                        @csrf

                        {{-- PRODUCTO --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Producto <span class="text-danger">*</span>
                            </label>

                            <select name="id_crea_producto"
                                    class="form-select @error('id_crea_producto') is-invalid @enderror"
                                    required>
                                <option value="">Seleccione un producto</option>

                                @foreach($productos as $p)
                                    <option value="{{ $p->id_crea_producto }}"
                                        {{ old('id_crea_producto') == $p->id_crea_producto ? 'selected' : '' }}>
                                        {{ $p->producto->nombre ?? 'Sin nombre' }}
                                        {{ $p->tipoproducto->nombre ?? 'Sin nombre'}}
                                        {{ $p->marca->nombre ?? 'Sin nombre'}}
                                    </option>
                                @endforeach
                            </select>

                            @error('id_crea_producto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">

                            {{-- PRECIO COMPRA --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">
                                    Precio de compra <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number"
                                           step="0.01"
                                           min="0"
                                           name="precio_compra"
                                           value="{{ old('precio_compra') }}"
                                           class="form-control @error('precio_compra') is-invalid @enderror"
                                           placeholder="0.00"
                                           required>

                                    @error('precio_compra')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- CANTIDAD --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">
                                    Cantidad <span class="text-danger">*</span>
                                </label>

                                <input type="number"
                                       min="1"
                                       name="cantidad"
                                       value="{{ old('cantidad') }}"
                                       class="form-control @error('cantidad') is-invalid @enderror"
                                       placeholder="Ej. 10"
                                       required>

                                @error('cantidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        {{-- FECHA --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Fecha de ingreso <span class="text-danger">*</span>
                            </label>

                            <input type="date"
                                   name="fecha"
                                   value="{{ old('fecha', date('Y-m-d')) }}"
                                   class="form-control @error('fecha') is-invalid @enderror"
                                   required>

                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        {{-- BOTONES --}}
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('inventarios.index') }}"
                               class="btn btn-outline-secondary px-4">
                                Cancelar
                            </a>

                            <button type="button"
                                    id="btnGuardar"
                                    class="btn btn-success px-4">
                                Guardar inventario
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnGuardar = document.getElementById('btnGuardar');
            const formInventario = document.getElementById('formInventario');

            btnGuardar.addEventListener('click', function () {

                if (!formInventario.checkValidity()) {
                    formInventario.reportValidity();
                    return;
                }

                Swal.fire({
                    title: '¿Guardar inventario?',
                    text: 'Verifique que la información capturada sea correcta.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formInventario.submit();
                    }
                });

            });
        });
    </script>
@endsection