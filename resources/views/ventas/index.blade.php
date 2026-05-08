@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-secondary">Punto de Venta</h2>
    <a href="{{ route('ventas.create') }}" class="btn btn-primary">
        + Nueva Venta
    </a>
</div>

@foreach($ventas as $venta)

<div class="card shadow-sm mb-4 border-0">

    <div class="card-header bg-dark text-white d-flex justify-content-between">
        <div>
            🧾 Venta #{{ $venta->id_venta }} |
            📅 {{ $venta->fecha }}
        </div>
        <div class="fw-bold">
            Total: ${{ $venta->total }}
        </div>
    </div>

    <div class="card-body">

        {{-- PRODUCTOS --}}
        <h6 class="text-primary">📦 Productos</h6>

        @forelse($venta->detalles as $d)
            <div class="d-flex justify-content-between border-bottom py-1">
                <div>
                    {{ $d->producto->producto->nombre ?? '' }}
                    {{ $d->producto->marca->nombre ?? '' }}
                </div>
                <div>
                    ${{ $d->producto->precio_venta }}
                    x {{ $d->cantidad }}
                </div>
            </div>
        @empty
            <small class="text-muted">Sin productos</small>
        @endforelse

        <hr>

        {{-- SERVICIOS --}}
        <h6 class="text-success">🧾 Servicios</h6>

        @forelse($venta->servicios as $s)
            <div class="d-flex justify-content-between border-bottom py-1">
                <div>
                    {{ $s->categoria->nombre ?? '' }}
                </div>
                <div>
                    ${{ $s->monto }}
                </div>
            </div>
        @empty
            <small class="text-muted">Sin servicios</small>
        @endforelse

    </div>

</div>

@endforeach

@endsection