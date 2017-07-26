<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

class PersonasTelefono extends modelo
{
    protected $table = 'personas_telefono';
    protected $fillable = ["personas_id","tipo_telefono_id","numero","principal"];
    protected $campos = [
        'tipo_telefono_id' => [
            'type'        => 'select',
            'label'       => 'Tipo telefono',
            'placeholder' => '- Eeleccione un Tipo telefono',
            'url'         => 'telefonotipo'
        ],
        'numero' => [
            'type'        => 'text',
            'label'       => 'Numero',
            'placeholder' => 'Numero del Personas Telefono'
        ]
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->campos['tipo_telefono_id']['options'] = TipoTelefono::pluck('nombre', 'id');
    }
    public function personas()
    {
        return $this->belongsTo('App\Modules\Base\Models\Personas', 'personas_id');
    }  

    public function tipotelefono()
    {
        return $this->belongsTo('App\Modules\Base\Models\TipoTelefono', 'tipo_telefono_id');
    }  
}