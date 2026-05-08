<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calidad extends Model
{
    protected $table = 'calidades'; // Nombre en tu SQL
    protected $primaryKey = 'id_calidad'; // Tu llave personalizada
    protected $fillable = ['nombre'];
    public $timestamps = false;
}
