@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Crear Producto</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('crear_productos.store') }}" method="POST">
                        @csrf

                        {{-- PRODUCTO --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Producto:</label>
                            <select name="id_producto" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach($productos as $p)
                                    <option value="{{ $p->id_producto }}">{{ $p->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- MARCA --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Marca:</label>
                            <select name="id_marca" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach($marcas as $m)
                                    <option value="{{ $m->id_marca }}">{{ $m->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TIPO --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tipo de Producto:</label>
                            <select name="id_tipo_producto" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach($tipos as $t)
                                    <option value="{{ $t->id_tipo_producto }}">{{ $t->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- CALIDAD --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Calidad:</label>
                            <select name="id_calidad" class="form-control" required>
                                <option value="">Seleccione</option>
                                @foreach($calidades as $c)
                                    <option value="{{ $c->id_calidad }}">{{ $c->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PRECIO --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Precio Venta:</label>
                            <input type="number" step="0.01" name="precio_venta"
                                   class="form-control" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('crear_productos.index') }}"
                               class="btn btn-secondary">Cancelar</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection