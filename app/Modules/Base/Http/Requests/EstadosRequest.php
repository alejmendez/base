<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class EstadosRequest extends Request {
    protected $reglasArr = [
		'nombre' => ['required', 'min:3', 'max:100'], 
		'iso_3166-2' => ['required', 'min:3', 'max:100']
	];
}