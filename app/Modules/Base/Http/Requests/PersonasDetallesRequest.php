<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class PersonasDetallesRequest extends Request {
    protected $reglasArr = [
		'personas_id' => ['required', 'integer', 'unique:personas_detalles,personas_id'], 
		'profesion_id' => ['required', 'integer'], 
		'sexo' => ['required', 'min:3', 'max:1'], 
		'fecha_nacimiento' => ['required', 'date_format:"d/m/Y"']
	];
}