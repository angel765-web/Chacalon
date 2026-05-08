@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Nuevo Servicio</h3>

    <form action="{{ route('servicios.store') }}" method="POST">
        @csrf

        {{-- VENTA --}}
        <div class="mb-3">
            <label>Venta</label>
            <select name="id_venta" class="form-control" required>
                @foreach($ventas as $venta)
                    <option value="{{ $venta->id_venta }}">
                        Venta #{{ $venta->id_venta }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- CATEGORÍA --}}
        <div class="mb-3">
            <label>Servicio</label>
            <select name="id_categoria_servicio" class="form-control" required>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id_categoria_servicio }}">
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- MONTO --}}
        <div class="mb-3">
            <label>Monto</label>
            <input type="number" step="0.01" name="monto" class="form-control" required>
        </div>

        {{-- COMISIÓN --}}
        <div class="mb-3">
            <label>Comisión (opcional)</label>
            <input type="number" step="0.01" name="comision" class="form-control">
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>

    </form>

</div>
@endsection