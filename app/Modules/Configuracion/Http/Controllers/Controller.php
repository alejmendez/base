<?php

namespace App\Modules\Configuracion\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController {
	public $app = 'base';

	protected $patch_js = [
		'public/js',
		'public/plugins',
		'app/Modules/Configuracion/Assets/js',
	];

	protected $patch_css = [
		'public/css',
		'public/plugins',
		'app/Modules/Configuracion/Assets/css',
	];
}