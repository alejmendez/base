<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

class TipoTelefono extends modelo
{
    protected $table = 'tipo_telefono';
    protected $fillable = ["nombre"];
    protected $campos = [
        'nombre' => [
            'type'        => 'text',
            'label'       => 'Nombre',
            'placeholder' => 'Nombre del Tipo Telefono'
        ]
    ];

    public function personatelefono()
    {
        return $this->hasMany('App\Modules\Base\Models\PersonasTelefono', 'tipo_telefono_id');
    }
}