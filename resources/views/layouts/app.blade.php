<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papelería May | Sistema</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- ICONOS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        /* SIDEBAR */
        .sidebar {
            min-height: 100vh;
            background: #1e1e2f;
            color: white;
            padding-top: 20px;
        }

        .sidebar h4 {
            font-weight: bold;
        }

        .sidebar a {
            color: #b5b5c3;
            text-decoration: none;
            padding: 12px 18px;
            display: block;
            border-radius: 8px;
            margin: 4px 10px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #2a2a3d;
            color: #fff;
        }

        .sidebar a.active {
            background: #0d6efd;
            color: white;
        }

        .section-title {
            font-size: 11px;
            margin: 15px 18px 5px;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* MAIN */
        .main-content {
            padding: 25px;
        }

        /* TOP BAR */
        .topbar {
            background: white;
            padding: 10px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <nav class="col-md-3 col-lg-2 sidebar">

            <h4 class="text-center mb-4">📚 Papelería May</h4>

            <div class="section-title">Operaciones</div>
            <a href="{{ route('home') }}">
                <i class="bi bi-house"></i> Home
            </a>

            <a href="/ventas"><i class="bi bi-cash-coin"></i> Punto de Venta</a>

            <div class="section-title">Almacén</div>

            <a href="/inventarios"><i class="bi bi-box-seam"></i> Inventario</a>
            <a href="/crear_productos"><i class="bi bi-plus-square"></i> Productos</a>

            <div class="section-title">Configuración</div>

            <a href="{{ route('productos.index') }}">
                <i class="bi bi-list"></i> Catálogo Base
            </a>
            <a href="/marcas"><i class="bi bi-tag"></i> Marcas</a>
            <a href="/tipos"><i class="bi bi-pencil"></i> Tipos</a>
            <a href="/calidades"><i class="bi bi-star"></i> Calidades</a>
            <a href="/catalogo_servicios"><i class="bi bi-gear"></i> Extras</a>

        </nav>

        <!-- CONTENIDO -->
        <main class="col-md-9 ms-sm-auto col-lg-10 main-content">

            <!-- TOP BAR -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sistema de Papelería</h5>
                <span class="text-muted">Panel administrativo</span>
            </div>

            @yield('content')

        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

</body>
</html>
