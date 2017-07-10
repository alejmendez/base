<?php

namespace App\Modules\Generador\Http\Requests;

use App\Http\Requests\Request;

class GeneradorRequest extends Request {
	protected $reglasArr = [
		'modulo'	=> ['required', 'min:3'],
		'tabla'		=> ['required', 'regex:/^[a-zA-Z0-9_]+$/', 'min:3']
	];
}