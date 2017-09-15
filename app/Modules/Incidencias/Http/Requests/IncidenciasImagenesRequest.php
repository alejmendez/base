<?php

namespace App\Modules\Incidencias\Http\Requests;

use App\Http\Requests\Request;

class IncidenciasImagenesRequest extends Request {
    protected $reglasArr = [
		'incidencias_id' => ['required', 'integer'], 
		'url' => ['required', 'min:3', 'max:255']
	];
}