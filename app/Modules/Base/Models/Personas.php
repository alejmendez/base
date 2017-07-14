<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;



class Personas extends modelo
{
    protected $table = 'personas';
    protected $fillable = ["tipo_persona_id","dni","nombres","foto"];
    public $campos = [
        'tipo_persona_id' => [
            'type'       => 'select',
            'label'      => 'Tipo Persona',
            'url'        => 'personas/tipopersona',
            'cont_class' => 'form-group col-md-3'
        ],
        'dni' => [
            'type'        => 'text',
            'label'       => 'C.I',
            'placeholder' => 'C.I del Personas',
            'cont_class'  => 'form-group col-md-3'
        ],
        'nombres' => [
            'type'        => 'text',
            'label'       => 'Nombres y Apellidos',
            'placeholder' => 'Nombres y Apellidos del Personas',
            'cont_class'  => 'form-group col-md-6'
        ]
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->campos['tipo_persona_id']['options'] = TipoPersona::pluck('nombre', 'id');
    }

    public function usuario()
    {
        return $this->hasMany('App\Modules\Base\Models\Usuario', 'personas_id');
    }

    public function tipo_persona()
    {
    	return $this->belongsTo('App\Modules\Base\Models\TipoPersona', 'tipo_persona_id');
	}

    public function personadetalle()
    {
        return $this->hasOne('App\Modules\Base\Models\PersonasDetalles', 'personas_id');
    } 
    
    public function personadireccion()
    {
        return $this->hasOne('App\Modules\Base\Models\PersonasDireccion', 'personas_id');
    } 
    public function personastelefono()
    {
        return $this->hasMany('App\Modules\Base\Models\PersonasTelefono', 'personas_id');
    }

	public function setCorreoAttribute($value)
    {
        $this->attributes['correo'] = strtolower($value);
    }
}