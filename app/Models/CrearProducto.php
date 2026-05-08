<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrearProducto extends Model
{
    protected $table = 'crear_productos';
    protected $primaryKey = 'id_crea_producto';

    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'id_tipo_producto',
        'id_marca',
        'id_calidad',
        'precio_venta'
    ];

    // RELACIONES

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'id_tipo_producto');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function calidad()
    {
        return $this->belongsTo(Calidad::class, 'id_calidad');
    }
}