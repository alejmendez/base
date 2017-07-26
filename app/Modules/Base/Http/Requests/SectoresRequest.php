<?php

namespace Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class SectoresRequest extends Request {
    protected $reglasArr = [
		'nombre' => ['required', 'min:3', 'max:100'], 
		'slug' => ['required', 'min:3', 'max:100', 'unique:sectores,slug'], 
		'parroquias_id' => ['integer', 'unique:sectores,parroquias_id']
	];
}