@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-warning">
                    <h5 class="mb-0">✏️ Editar Marca</h5>
                </div>

                <div class="card-body p-4">

                    {{-- ================= ALERTA DE ERRORES ================= --}}
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm">
                            <strong class="d-block mb-2">Ups, revisa esto:</strong>

                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- ================= ALERTA DE ÉXITO (OPCIONAL) ================= --}}
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- ================= FORM ================= --}}
                    <form action="{{ route('marcas.update', $marca->id_marca) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre de la marca</label>
                            <input type="text"
                                   name="nombre"
                                   value="{{ old('nombre', $marca->nombre) }}"
                                   class="form-control"
                                   placeholder="Ej. Bic, Pilot, Scribe..."
                                   required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('marcas.index') }}" class="btn btn-light">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection