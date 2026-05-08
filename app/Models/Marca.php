<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    // 1. Le decimos el nombre real de la tabla en tu MariaDB
    protected $table = 'marcas';

    // 2. Le indicamos cuál es tu llave primaria personalizada
    protected $primaryKey = 'id_marca';

    // 3. Definimos qué columnas se pueden llenar desde un formulario
    protected $fillable = ['nombre'];

    // 4. Como tu SQL no tiene las columnas 'created_at' y 'updated_at', 
    // desactivamos los timestamps para que no nos dé error.
    public $timestamps = false;
}
