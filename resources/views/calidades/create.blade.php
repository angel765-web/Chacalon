@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Agregar Nueva Calidad</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('calidades.store') }}" method="POST">

                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tipo de calidad:</label>
                            <input type="text" name="nombre" class="form-control" required autofocus>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{{ route('marcas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection