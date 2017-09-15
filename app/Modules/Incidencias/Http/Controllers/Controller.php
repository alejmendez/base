<?php

namespace App\Modules\Incidencias\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController {
	public $app = 'Incidencias';

	protected $patch_js = [
		'public/js',
		'public/plugins',
		'app/Modules/Incidencias/Assets/js',
	];

	protected $patch_css = [
		'public/css',
		'public/plugins',
		'app/Modules/Incidencias/Assets/css',
	];
}