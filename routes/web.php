<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CalidadController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\CategoriaServicioController;
use App\Http\Controllers\CrearProductoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\HomeController;

Route::resource('productos', ProductoController::class);
Route::resource('marcas', MarcaController::class);
Route::resource('calidades', CalidadController::class);
Route::resource('tipos', TipoProductoController::class);
Route::resource('catalogo_servicios', CategoriaServicioController::class);
Route::resource('crear_productos', CrearProductoController::class);

// RUTA AGREGADA: Maneja la nueva vista agrupada y filtrada del historial
Route::get('inventarios/historial', [InventarioController::class, 'historial'])->name('inventarios.historial');

Route::resource('inventarios', InventarioController::class);
Route::resource('ventas', VentaController::class);
Route::resource('servicios', ServicioController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
