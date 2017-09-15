<?php

namespace App\Modules\Incidencias\Models;

use App\Modules\Base\Models\Modelo;

class IncidenciasImagenes extends Modelo
{
    protected $table = 'incidencias_imagenes';
    protected $fillable = ["incidencias_id","url"];

   
}