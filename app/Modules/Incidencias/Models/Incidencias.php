<?php

namespace App\Modules\Incidencias\Models;

use App\Modules\Base\Models\Modelo;


class Incidencias extends Modelo
{
    protected $table = 'incidencias';
    protected $fillable = ["titulo","descripcion","app_usuario_id","app_perfil_id","estatus_id","correo"];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
    }

    
}