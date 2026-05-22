@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Encabezado de la Vista -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('ventas.index') }}" class="text-decoration-none text-muted small fw-semibold">
                ← Volver al Panel de Ventas
            </a>
            <h2 class="fw-bold text-dark mt-1 mb-1">Registrar Nueva Venta</h2>
            <p class="text-muted small mb-0">Capture los productos o servicios para procesar la transacción.</p>
        </div>
    </div>

    {{-- MANEJO DE ERRORES GLOBALES EN SERVIDOR --}}
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <strong class="d-block mb-2">Por favor verifique los siguientes detalles:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="formVentas" action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            {{-- ================= SECCIÓN PRODUCTOS ================= --}}
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 h-100 bg-white p-3">
                    <h5 class="text-primary fw-bold mb-3">📦 Productos</h5>

                    <div id="productos">
                        <div class="row g-2 mb-2 producto-item">
                            <div class="col-md-8">
                                <select name="productos[0][id_crea_producto]" class="form-select select-producto">
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

                            <div class="col-md-4">
                                <input type="number"
                                       min="1"
                                       name="productos[0][cantidad]"
                                       class="form-control input-cantidad"
                                       placeholder="Cant.">
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-primary mt-3 fw-semibold w-100" onclick="agregarProducto()">
                        + Agregar Otro Producto
                    </button>
                </div>
            </div>

            {{-- ================= SECCIÓN SERVICIOS ================= --}}
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 h-100 bg-white p-3">
                    <h5 class="text-success fw-bold mb-3">🧾 Servicios</h5>

                    <div id="servicios">
                        <div class="row g-2 mb-2 servicio-item">
                            <div class="col-md-6">
                                <select name="servicios[0][id_categoria_servicio]" class="form-select">
                                    <option value="">-- Seleccione un Servicio --</option>
                                    @foreach($categorias as $c)
                                        <option value="{{ $c->id_categoria_servicio }}">
                                            {{ $c->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="servicios[0][monto]"
                                       class="form-control input-monto"
                                       placeholder="Monto">
                            </div>

                            <div class="col-md-3">
                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="servicios[0][comision]"
                                       class="form-control"
                                       placeholder="Comisión">
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-success mt-3 fw-semibold w-100" onclick="agregarServicio()">
                        + Agregar Otro Servicio
                    </button>
                </div>
            </div>

        </div>

        <hr class="my-4">

        {{-- BOTONES DE ACCIÓN --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary px-4 fw-semibold">
                Cancelar
            </a>
            <button type="button" id="btnFinalizar" class="btn btn-success px-4 fw-bold shadow">
                Finalizar Venta
            </button>
        </div>

    </form>
</div>

{{-- ================= JAVASCRIPT LOCAL INMUNE A CAÍDAS DE RED ================= --}}
<script>
let iProducto = 1;
let iServicio = 1;

function agregarProducto() {
    let html = `
    <div class="row g-2 mb-2 producto-item">
        <div class="col-md-8">
            <select name="productos[${iProducto}][id_crea_producto]" class="form-select select-producto">
                <option value="">-- Seleccione un Producto --</option>
                @foreach($productos as $p)
                    <option value="{{ $p->id_crea_producto }}" data-stock="{{ $p->stock_actual }}">
                        {{ $p->producto->nombre ?? 'Sin nombre' }} {{ $p->marca->nombre ?? '' }} [Stock: {{ $p->stock_actual }}] - $${{ number_format($p->precio_venta, 2) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" min="1" name="productos[${iProducto}][cantidad]" class="form-control input-cantidad" placeholder="Cant.">
        </div>
    </div>
    `;
    document.getElementById('productos').insertAdjacentHTML('beforeend', html);
    iProducto++;
}

function agregarServicio() {
    let html = `
    <div class="row g-2 mb-2 servicio-item">
        <div class="col-md-6">
            <select name="servicios[${iServicio}][id_categoria_servicio]" class="form-select">
                <option value="">-- Seleccione un Servicio --</option>
                @foreach($categorias as $c)
                    <option value="{{ $c->id_categoria_servicio }}">
                        {{ $c->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" step="0.01" min="0" name="servicios[${iServicio}][monto]" class="form-control input-monto" placeholder="Monto">
        </div>
        <div class="col-md-3">
            <input type="number" step="0.01" min="0" name="servicios[${iServicio}][comision]" class="form-control" placeholder="Comisión">
        </div>
    </div>
    `;
    document.getElementById('servicios').insertAdjacentHTML('beforeend', html);
    iServicio++;
}

// ALERTA Y FILTRO DE CONTROL DE STOCK INSTANTÁNEO
document.addEventListener('DOMContentLoaded', function () {
    const btnFinalizar = document.getElementById('btnFinalizar');
    const formVentas = document.getElementById('formVentas');

    btnFinalizar.addEventListener('click', function () {
        
        let carritoVacio = true;
        let stockSuperado = false;
        let mensajeStock = "";

        // 1. Analizar todas las filas de productos actuales en la pantalla
        const itemsProductos = document.querySelectorAll('#productos .producto-item');
        itemsProductos.forEach(fila => {
            const selectElement = fila.querySelector('.select-producto');
            const cantidadInput = fila.querySelector('.input-cantidad');
            
            if (selectElement && cantidadInput) {
                const idProducto = selectElement.value;
                const cantidadVenta = parseInt(cantidadInput.value) || 0;

                if (idProducto !== "" && cantidadVenta > 0) {
                    carritoVacio = false; // Hay al menos un artículo válido

                    // Leer las existencias asignadas en el data-stock de la opción elegida
                    const optionSeleccionada = selectElement.options[selectElement.selectedIndex];
                    const stockDisponible = parseInt(optionSeleccionada.getAttribute('data-stock')) || 0;

                    // Bloquear si intentan capturar más piezas de las existentes
                    if (cantidadVenta > stockDisponible) {
                        stockSuperado = true;
                        // Extraemos el texto limpio del producto para el mensaje
                        const textoCompleto = optionSeleccionada.text;
                        const nombreLimpio = textoCompleto.substring(0, textoCompleto.indexOf('[')).trim();
