<?php

namespace Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class PersonasBancosRequest extends Request {
    protected $reglasArr = [
		'personas_id' => ['required', 'integer'], 
		'bancos_id' => ['required', 'integer'], 
		'tipo_cuenta_id' => ['required', 'integer'], 
		'correo' => ['required', 'min:3', 'max:20', 'unique:personas_bancos,correo']
	];
}