<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class ProfesionRequest extends Request {
    protected $reglasArr = [
		'nombre' => ['required', 'min:3', 'max:100']
	];
}