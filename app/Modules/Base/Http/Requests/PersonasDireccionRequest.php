<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class PersonasDireccionRequest extends Request {
    protected $reglasArr = [
		'personas_id' => ['integer', 'min:3', 'max:200', 'unique:personas_direccion,personas_id'], 
		'estados_id' => ['integer', 'min:3', 'max:200', 'unique:personas_direccion,personas_id'], 
		'ciudade_id' => ['integer', 'min:3', 'max:200', 'unique:personas_direccion,personas_id'], 
		'municipio_id' => ['integer', 'min:3', 'max:200', 'unique:personas_direccion,personas_id'], 
		'parroquia_id' => ['integer', 'min:3', 'max:200', 'unique:personas_direccion,personas_id'], 
		'sector_id' => ['integer', 'min:3', 'max:200', 'unique:personas_direccion,personas_id'], 
		'direccion' => ['min:3', 'max:200', 'unique:personas_direccion,personas_id']
	];
}