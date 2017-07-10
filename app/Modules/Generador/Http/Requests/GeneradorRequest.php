<?php

namespace App\Modules\Generador\Http\Requests;

use App\Http\Requests\Request;

class GeneradorRequest extends Request {
	protected $reglasArr = [
		'modulo'	=> ['required', 'min:3'],
		'tabla'		=> ['regex:/^[a-zA-Z0-9_]+$/', 'min:3'],
		'nombre'	=> ['required_if:tabla,', 'regex:/^[a-zA-Z0-9_]+$/', 'min:3']
	];
}