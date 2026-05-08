<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto'; // Tu llave de la BD
    protected $fillable = ['nombre'];
    public $timestamps = false;
}
