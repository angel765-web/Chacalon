@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Editar Producto</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('crear_productos.update', $crear->id_crea_producto) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        {{-- PRODUCTO --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Producto:</label>
                            <select name="id_producto" class="form-control" required>
                                @foreach($productos as $p)
                                    <option value="{{ $p->id_producto }}"
                                        {{ $crear->id_producto == $p->id_producto ? 'selected' : '' }}>
                                        {{ $p->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- MARCA --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Marca:</label>
                            <select name="id_marca" class="form-control" required>
                                @foreach($marcas as $m)
                                    <option value="{{ $m->id_marca }}"
                                        {{ $crear->id_marca == $m->id_marca ? 'selected' : '' }}>
                                        {{ $m->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TIPO --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tipo:</label>
                            <select name="id_tipo_producto" class="form-control" required>
                                @foreach($tipos as $t)
                                    <option value="{{ $t->id_tipo_producto }}"
                                        {{ $crear->id_tipo_producto == $t->id_tipo_producto ? 'selected' : '' }}>
                                        {{ $t->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- CALIDAD --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Calidad:</label>
                            <select name="id_calidad" class="form-control" required>
                                @foreach($calidades as $c)
                                    <option value="{{ $c->id_calidad }}"
                                        {{ $crear->id_calidad == $c->id_calidad ? 'selected' : '' }}>
                                        {{ $c->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PRECIO --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Precio Venta:</label>
                            <input type="number" step="0.01"
                                   name="precio_venta"
                                   value="{{ $crear->precio_venta }}"
                                   class="form-control" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Actualizar</button>
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