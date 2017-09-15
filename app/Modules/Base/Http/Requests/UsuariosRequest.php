<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class UsuariosRequest extends Request {
	protected $reglasArr = [
		'usuario'        => ['required', 'usuario', 'min:3', 'max:50', 'unique:app_usuario,usuario'],
		'password'       => ['required', 'password', 'min:8', 'max:50'],
		'dni'            => ['required', 'integer', 'unique:personas,dni'],
		'nombres'         => ['required', 'nombre', 'min:3', 'max:50'],
		'correo'         => ['max:50', 'unique:personas_correo,correo'],
		'telefono'       => ['telefono', 'min:3', 'max:15'],
		//'foto'           => ['mimes:jpeg,png,jpg'],
		'perfil_id'	     => ['required', 'integer'],
		//'autenticacion'  => ['required'],
		'super'          => ['required'],
	
	
	];

	public function rules() {
		$rules = parent::rules();

		switch ($this->method()){
			case 'PUT':
			case 'PATCH':
				if ($this->input('password') == '') {
					unset($rules['password']);
				}
				if ($this->input('nombres') == '') {
					unset($rules['nombres']);
				}

				break;
		}

		return $rules;
	}
}