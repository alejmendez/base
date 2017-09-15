<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class TipoNotificacionRequest extends Request {
    protected $reglasArr = [
		'nombre' => ['required', 'min:3', 'max:200'], 
		'ruta' => ['required', 'min:3', 'max:255']
	];
}