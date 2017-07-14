<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class TipoTelefonoRequest extends Request {
    protected $reglasArr = [
		'nombre' => ['required', 'min:3', 'max:100']
	];
}