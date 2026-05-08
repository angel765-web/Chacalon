<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = 'tipo_productos';
    protected $primaryKey = 'id_tipo_producto';
    protected $fillable = ['nombre'];
    public $timestamps = false;
}
