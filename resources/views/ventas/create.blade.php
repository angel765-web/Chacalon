@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">Punto de Venta</h3>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="row">

            {{-- ================= PRODUCTOS ================= --}}
            <div class="col-md-6">

                <h5 class="text-primary">📦 Productos</h5>

                <div id="productos">

                    <div class="row mb-2 producto-item">

                        <div class="col-md-7">
                            <select name="productos[0][id_crea_producto]" class="form-control">
                                @foreach($productos as $p)
                                   <option value="{{ $p->id_crea_producto }}">
                                        {{ $p->producto->nombre ?? '' }}
                                        {{ $p->marca->nombre ?? '' }}
                                        {{ $p->tipoProducto->nombre ?? '' }}
                                        ${{ $p->precio_venta }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="number"
                                   name="productos[0][cantidad]"
                                   class="form-control"
                                   placeholder="Cant">
                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="agregarProducto()">
                    + Agregar Producto
                </button>

            </div>

            {{-- ================= SERVICIOS ================= --}}
            <div class="col-md-6">

                <h5 class="text-success">🧾 Servicios</h5>

                <div id="servicios">

                    <div class="row mb-2 servicio-item">

                        <div class="col-md-5">
                            <select name="servicios[0][id_categoria_servicio]" class="form-control">
                                @foreach($categorias as $c)
                                    <option value="{{ $c->id_categoria_servicio }}">
                                        {{ $c->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="number"
                                   step="0.01"
                                   name="servicios[0][monto]"
                                   class="form-control"
                                   placeholder="Monto">
                        </div>

                        <div class="col-md-3">
                            <input type="number"
                                   step="0.01"
                                   name="servicios[0][comision]"
                                   class="form-control"
                                   placeholder="Comisión">
                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="agregarServicio()">
                    + Agregar Servicio
                </button>

            </div>

        </div>

        <hr>

        <button class="btn btn-success">
            Finalizar Venta
        </button>

        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

{{-- ================= JAVASCRIPT ================= --}}
<script>
let iProducto = 1;
let iServicio = 1;

function agregarProducto() {
    let html = `
    <div class="row mb-2">

        <div class="col-md-7">
            <select name="productos[${iProducto}][id_crea_producto]" class="form-control">
                @foreach($productos as $p)
                    <option value="{{ $p->id_crea_producto }}">
                        {{ $p->producto->nombre ?? '' }} - ${{ $p->precio_venta }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <input type="number" name="productos[${iProducto}][cantidad]" class="form-control" placeholder="Cant">
        </div>

    </div>
    `;

    document.getElementById('productos').insertAdjacentHTML('beforeend', html);
    iProducto++;
}

function agregarServicio() {
    let html = `
    <div class="row mb-2">

        <div class="col-md-5">
            <select name="servicios[${iServicio}][id_categoria_servicio]" class="form-control">
                @foreach($categorias as $c)
                    <option value="{{ $c->id_categoria_servicio }}">
                        {{ $c->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <input type="number" step="0.01" name="servicios[${iServicio}][monto]" class="form-control" placeholder="Monto">
        </div>

        <div class="col-md-3">
            <input type="number" step="0.01" name="servicios[${iServicio}][comision]" class="form-control" placeholder="Comisión">
        </div>

    </div>
    `;

    document.getElementById('servicios').insertAdjacentHTML('beforeend', html);
    iServicio++;
}
</script>

@endsection