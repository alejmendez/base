<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class MensajeRequest extends Request {
    protected $reglasArr = [
		'mensaje' => ['required', 'min:3', 'max:200']
	];
}