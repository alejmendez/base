<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

use App\Modules\Base\Models\Mensaje;
use App\Modules\Base\Models\TipoNotificacion;

class Notificaciones extends Modelo
{
    protected $table = 'notificaciones';
    protected $fillable = ["usuario_id","enviado_id","mensaje_id","operacion_id","visto","tipo_notificacion_id"];
   
           
}