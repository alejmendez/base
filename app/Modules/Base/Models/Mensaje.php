<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;



class Mensaje extends Modelo
{
    protected $table = 'mensaje';
    protected $fillable = ["mensaje"];
    protected $campos = [
    'mensaje' => [
        'type' => 'text',
        'label' => 'Mensaje',
        'placeholder' => 'Mensaje del Mensaje'
    ]
];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
    }

    
}