@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Editar Calidad</h4>
                </div>
                <div class="card-body">
                        <form action="{{ route('calidades.update', $calidad->id_calidad) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- LÓGICA: Necesario para actualizaciones --}}
                        <div class="mb-3">
                            <label class="form-label">Tipo de Calidad:</label>
                            <input type="text" name="nombre" value="{{ $calidad->nombre }}" class="form-control">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('marcas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
