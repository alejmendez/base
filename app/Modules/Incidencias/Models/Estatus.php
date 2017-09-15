<?php

namespace App\Modules\Incidencias\Models;

use App\Modules\Base\Models\Modelo;

class Estatus extends Modelo
{
    protected $table = 'estatus';
    protected $fillable = ["nombre"];
    protected $campos = [
    'nombre' => [
        'type' => 'text',
        'label' => 'Nombre',
        'placeholder' => 'Nombre del Estatus'
    ]
];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }
}