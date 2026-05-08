@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-warning py-3">
                    <h5 class="mb-0">✏️ Editar Artículo Base</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nombre del Artículo:</label>
                            <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control form-control-lg" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Actualizar Cambios</button>
                            <a href="{{ route('productos.index') }}" class="btn btn-light">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
