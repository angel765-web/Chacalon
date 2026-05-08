<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetalleVenta;
use App\Models\Servicio;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'total'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'id_venta');
    }
}