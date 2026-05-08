@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Registrar Nuevo Tipo</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tipos.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Descripción (Ej: Cuadro Grande, Gel, etc):</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Escribe el tipo aquí..." required autofocus>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Guardar Tipo</button>
                            <a href="{{ route('tipos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
