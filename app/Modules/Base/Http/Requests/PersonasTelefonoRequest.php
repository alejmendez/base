<?php

namespace Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class PersonasTelefonoRequest extends Request {
    protected $reglasArr = [
		'personas_id' => ['required', 'integer'], 
		'tipo_telefono_id' => ['required', 'integer'], 
		'numero' => ['required', 'min:3', 'max:20', 'unique:personas_telefono,numero']
	];
}