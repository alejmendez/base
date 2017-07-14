<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

class PersonasCorreo extends modelo
{
    protected $table = 'personas_correo';
    protected $fillable = ["personas_id","principal","correo"];
    protected $campos = [
        'cuenta' => [
            'type'        => 'text',
            'label'       => 'Correo',
            'placeholder' => 'Correo',
            'cont_class'  => 'form-group col-md-6'
        ]
    ];

    public function personas()
    {
        return $this->belongsTo('App\Modules\Base\Models\Personas', 'personas_id');
    }  
} 