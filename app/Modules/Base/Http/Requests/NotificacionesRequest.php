<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class NotificacionesRequest extends Request {
    protected $reglasArr = [
		'usuario_id' => ['integer'], 
		'enviado_id' => ['required', 'integer'], 
		'mensaje_id' => ['required', 'integer'], 
		'operacion_id' => ['integer'], 
		'visto' => ['required'], 
		'tipo_notificacion_id' => ['required', 'integer']
	];
}