<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

class Profesion extends modelo
{
    protected $table = 'profesion';
    protected $fillable = ["nombre","slug"];
    protected $campos = [
        'nombre' => [
            'type'        => 'text',
            'label'       => 'Nombre',
            'placeholder' => 'Nombre del Profesion'
        ]
    ];

    public function personadetalle()
    {
        return $this->hasOne('App\Modules\Base\Models\PersonasDetalles', 'profesion_id');
    }
}