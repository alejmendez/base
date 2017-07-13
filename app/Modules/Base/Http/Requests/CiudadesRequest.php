<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class CiudadesRequest extends Request {
    protected $reglasArr = [
		'estados_id' => ['integer'], 
		'nombre' => ['required', 'min:3', 'max:100'], 
		'capital' => ['required']
	];
}