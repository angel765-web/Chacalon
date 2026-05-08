@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Editar Inventario</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('inventarios.update', $inventario->id_inventario) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        {{-- PRODUCTO --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Producto:</label>
                            <select name="id_crea_producto" class="form-control" required>
                                @foreach($productos as $p)
                                    <option value="{{ $p->id_crea_producto }}"
                                        {{ $inventario->id_crea_producto == $p->id_crea_producto ? 'selected' : '' }}>
                                        {{ $p->producto->nombre ?? 'Sin nombre' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PRECIO --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Precio Compra:</label>
                            <input type="number" step="0.01"
                                   name="precio_compra"
                                   value="{{ $inventario->precio_compra }}"
                                   class="form-control" required>
                        </div>

                        {{-- CANTIDAD --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cantidad:</label>
                            <input type="number"
                                   name="cantidad"
                                   value="{{ $inventario->cantidad }}"
                                   class="form-control" required>
                        </div>

                        {{-- FECHA --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha:</label>
                            <input type="date"
                                   name="fecha"
                                   value="{{ $inventario->fecha }}"
                                   class="form-control" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                            <a href="{{ route('inventarios.index') }}"
                               class="btn btn-secondary">Cancelar</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection