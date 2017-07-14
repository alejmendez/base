<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class PersonasCorreoRequest extends Request {
    protected $reglasArr = [
		'personas_id' => ['required', 'integer'], 
		'principal' => ['required'], 
		'cuenta' => ['required', 'min:3', 'max:200', 'unique:personas_correo,cuenta']
	];
}