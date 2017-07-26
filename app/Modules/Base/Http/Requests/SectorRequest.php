<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class SectorRequest extends Request {
    protected $reglasArr = [
		'nombre' => ['required', 'min:3', 'max:100'], 
		'parroquia_id' => ['integer', 'unique:sector,parroquia_id']
	];
}