<?php

namespace App\Modules\Incidencias\Http\Requests;

use App\Http\Requests\Request;

class EstatusRequest extends Request {
    protected $reglasArr = [
		'nombre' => ['required', 'min:3', 'max:255']
	];
}