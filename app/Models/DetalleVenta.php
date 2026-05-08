<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id_detalle_venta';
    public $timestamps = false;

    protected $fillable = [
        'id_venta',
        'id_crea_producto',
        'cantidad'
    ];

    // relación con venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    // relación con producto
    public function producto()
    {
        return $this->belongsTo(CrearProducto::class, 'id_crea_producto');
    }
}