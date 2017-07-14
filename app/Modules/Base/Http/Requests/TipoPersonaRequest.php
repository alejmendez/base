<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class TipoPersonaRequest extends Request {
    protected $reglasArr = [
		'nombre' => ['required', 'min:1', 'max:40']
	];
}