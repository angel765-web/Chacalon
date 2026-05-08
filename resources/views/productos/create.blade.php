@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">📦 Registrar Nuevo Artículo Base</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('productos.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nombre del Artículo:</label>
                            <input type="text" name="nombre" class="form-control form-control-lg" placeholder="Ej. Cartulina, Lápiz, Regla..." required autofocus>
                            <div class="form-text">Solo el nombre general, sin marca ni tipo.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">Guardar Artículo</button>
                            <a href="{{ route('productos.index') }}" class="btn btn-light">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
