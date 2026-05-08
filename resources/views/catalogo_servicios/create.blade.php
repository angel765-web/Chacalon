@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Registrar Categoría de Servicio</h4>
                </div>
                <div class="card-body">
                    {{-- LÓGICA: Cambiamos el guion bajo por medio para que coincida con web.php --}}
                    <form action="{{ route('catalogo_servicios.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre del Servicio:</label>
                            {{-- LÓGICA: Cambiamos el ejemplo para que sea coherente con servicios --}}
                            <input type="text" name="nombre" class="form-control" placeholder="Ej: Copias, Impresiones, Engargolado..." required autofocus>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Guardar Servicio</button>
                            <a href="{{ route('catalogo_servicios.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
