<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaServicio extends Model
{
    protected $table = 'categoria_servicios';
    protected $primaryKey = 'id_categoria_servicio';
    protected $fillable = ['nombre'];
    public $timestamps = false;
}
