<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';
    protected $primaryKey = 'id_servicio';
    public $timestamps = false;

    protected $fillable = [
        'id_categoria_servicio',
        'id_venta',
        'monto',
        'comision'
    ];

    // relación con categoría
    public function categoria()
    {
        return $this->belongsTo(CategoriaServicio::class, 'id_categoria_servicio');
    }

    // relación con venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }
}