<?php

namespace App\Modules\Base\Http\Requests;

use App\Http\Requests\Request;

class PersonasRequest extends Request {
    protected $reglasArr = [
		'tipo_persona_id' 	=> ['integer'], 
		'dni' 			  	=> ['required', 'min:8', 'max:20', 'unique:personas,dni'], 
		'nombres'         	=> ['required', 'min:3', 'max:200'],
		'profesion_id'    	=> ['required', 'integer'],
		'sexo'			  	=> ['required'],
		'fecha_nacimiento'  => ['required'],
		'estados_id'		=> ['required', 'integer'],
		'ciudades_id'		=> ['required', 'integer'],
		'municipios_id'		=> ['required', 'integer'],
		'parroquias_id'		=> ['required', 'integer'],
		'sectores_id'		=> ['required', 'integer'],
		'direccion'			=> ['required', 'min:8', 'max:200'],
		'numero_cuenta.*'   => ['size:20', 'unique:personas_bancos,cuenta']
		//'numero.*'   		=> ['unique:personas_telefono,numero'],
		//'correo.*'   		=> ['unique:personas_correo,correo']
	];


	public function rules() {
		$rules = parent::rules();

		switch ($this->method()){
			case 'PUT':
				unset($rules['numero_cuenta.*']);
				break;
		}


		switch ($this->method()){
			case 'PUT':
			case 'POST':
			case 'GET':
			case 'PATCH':
				if ($this->input('tipo_persona_id') != 1 && $this->input('tipo_persona_id') != 2) {
					unset($rules['profesion_id']);
					unset($rules['sexo']);
					unset($rules['fecha_nacimiento']);
				}

				if ($this->input('estados_id') == ''){
					unset($rules['estados_id']);
					unset($rules['ciudades_id']);
					unset($rules['municipio_id']);
					unset($rules['parroquia_id']);
					unset($rules['sector_id']);
					unset($rules['direccion']);
				}

				break;
		}

		return $rules;
	}
}


