<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventarios';
    protected $primaryKey = 'id_inventario';

    public $timestamps = false;

    protected $fillable = [
        'id_crea_producto',
        'precio_compra',
        'cantidad',
        'fecha'
    ];

    // Relación con productos creados
    public function productoCreado()
    {
        return $this->belongsTo(CrearProducto::class, 'id_crea_producto');
    }
}