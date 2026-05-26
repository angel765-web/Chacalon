@extends('layouts.app')

@section('content')
<div class="container py-4" style="font-family: system-ui, -apple-system, sans-serif; max-width: 1200px; margin: 0 auto; padding: 1.5rem;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
            <a href="{{ route('ventas.index') }}" style="text-decoration: none; color: #6c757d; font-size: 0.875rem; font-weight: 600;">
                ← Volver al Panel de Ventas
            </a>
            <h2 style="color: #212529; font-weight: 700; margin: 0.25rem 0 0 0; font-size: 1.75rem;">Registrar Nueva Venta</h2>
            <p style="color: #6c757d; font-size: 0.875rem; margin: 0;">Capture los productos o servicios para procesar la transacción.</p>
        </div>
    </div>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #842029; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem;">
            <strong style="display: block; margin-bottom: 0.5rem;">Por favor verifique los siguientes detalles:</strong>
            <ul style="margin: 0; padding-left: 1.25rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="formVentas" action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div style="display: flex; flex-wrap: wrap; gap: 1.5rem;">

            {{-- PRODUCTOS --}}
            <div style="flex: 1; min-width: 300px;">
                <div style="background: white; border-radius: 0.5rem; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075); padding: 1.25rem; border: 1px solid #e0e0e0; height: 100%;">
                    <h5 style="color: #0d6efd; font-weight: bold; margin-top: 0; margin-bottom: 1rem;">📦 Productos</h5>

                    <div id="productos">
                        <div class="producto-item" style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <div style="flex: 2;">
                                <select name="productos[0][id_crea_producto]" class="select-producto" style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 0.375rem;">
                                    <option value="">-- Seleccione un Producto --</option>
                                    @foreach($productos as $p)
                                       <option value="{{ $p->id_crea_producto }}" data-stock="{{ $p->stock_actual }}">
                                            {{ $p->producto->nombre ?? 'Sin nombre' }}
                                            {{ $p->marca->nombre ?? '' }}
                                            {{ $p->tipoProducto->nombre ?? '' }}
                                            [Stock: {{ $p->stock_actual }} pzas]
                                            (${{ number_format($p->precio_venta, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div style="flex: 1; max-width: 120px;">
                                <input type="number" min="1" name="productos[0][cantidad]" class="input-cantidad" placeholder="Cant." style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 0.375rem;">
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="agregarProducto()" style="border: 1px solid #0d6efd; color: #0d6efd; background: none; width: 100%; padding: 0.5rem; margin-top: 1rem;">
                        + Agregar Otro Producto
                    </button>
                </div>
            </div>

            {{-- SERVICIOS --}}
            <div style="flex: 1; min-width: 300px;">
                <div style="background: white; border-radius: 0.5rem; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075); padding: 1.25rem; border: 1px solid #e0e0e0; height: 100%;">
                    <h5 style="color: #198754; font-weight: bold; margin-top: 0; margin-bottom: 1rem;">🧾 Servicios</h5>

                    <div id="servicios">
                        <div class="servicio-item" style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <div style="flex: 2;">
                                <select name="servicios[0][id_categoria_servicio]" style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 0.375rem;">
                                    <option value="">-- Seleccione un Servicio --</option>
                                    @foreach($categorias as $c)
                                        <option value="{{ $c->id_categoria_servicio }}">
                                            {{ $c->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div style="flex: 1;">
                                <input type="number" step="0.01" min="0" name="servicios[0][monto]" placeholder="Monto"
                                       style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 0.375rem;">
                            </div>

                            <div style="flex: 1;">
                                <input type="number" step="0.01" min="0" name="servicios[0][comision]" placeholder="Comisión"
                                       style="width: 100%; padding: 0.375rem 0.75rem; border: 1px solid #ced4da; border-radius: 0.375rem;">
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="agregarServicio()" style="border: 1px solid #198754; color: #198754; background: none; width: 100%; padding: 0.5rem; margin-top: 1rem;">
                        + Agregar Otro Servicio
                    </button>
                </div>
            </div>

        </div>

        <hr style="margin: 2rem 0;">

        <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
            <a href="{{ route('ventas.index') }}" style="border: 1px solid #6c757d; color: #6c757d; padding: 0.5rem 1rem; text-decoration: none;">
                Cancelar
            </a>

            <button type="button" id="btnFinalizar"
                    style="background: #198754; color: white; border: none; padding: 0.5rem 1rem;">
                Finalizar Venta
            </button>
        </div>

    </form>
</div>

{{-- ================= SWEETALERT ================= --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

let iProducto = 1;
let iServicio = 1;

/* PRODUCTOS */
function agregarProducto() {

    let html = `
    <div class="producto-item" style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
        <div style="flex:2;">
            <select name="productos[${iProducto}][id_crea_producto]" class="select-producto" style="width:100%; padding:0.375rem; border:1px solid #ccc;">
                <option value="">-- Seleccione un Producto --</option>
                @foreach($productos as $p)
                    <option value="{{ $p->id_crea_producto }}">
                        {{ $p->producto->nombre ?? 'Sin nombre' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="flex:1;">
            <input type="number" name="productos[${iProducto}][cantidad]" min="1" placeholder="Cant."
                   style="width:100%; padding:0.375rem;">
        </div>
    </div>`;

    document.getElementById('productos').insertAdjacentHTML('beforeend', html);
    iProducto++;
}

/* SERVICIOS */
function agregarServicio() {

    let html = `
    <div class="servicio-item" style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
        <div style="flex:2;">
            <select name="servicios[${iServicio}][id_categoria_servicio]" style="width:100%; padding:0.375rem; border:1px solid #ccc;">
                <option value="">-- Seleccione un Servicio --</option>
                @foreach($categorias as $c)
                    <option value="{{ $c->id_categoria_servicio }}">
                        {{ $c->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="flex:1;">
            <input type="number" name="servicios[${iServicio}][monto]" step="0.01" placeholder="Monto"
                   style="width:100%; padding:0.375rem;">
        </div>

        <div style="flex:1;">
            <input type="number" name="servicios[${iServicio}][comision]" step="0.01" placeholder="Comisión"
                   style="width:100%; padding:0.375rem;">
        </div>
    </div>`;

    document.getElementById('servicios').insertAdjacentHTML('beforeend', html);
    iServicio++;
}

/* ================= FINALIZAR CON SWAL ================= */
document.getElementById('btnFinalizar').addEventListener('click', function () {

    Swal.fire({
        title: "¿Finalizar venta?",
        text: "Se guardará la venta en el sistema",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, finalizar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#198754",
        cancelButtonColor: "#6c757d"
    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                icon: "success",
                title: "Guardando venta...",
                showConfirmButton: false,
                timer: 900
            });

            document.getElementById('formVentas').submit();
        }

    });

});

</script>

@endsection