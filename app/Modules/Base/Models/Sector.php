<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

class Sector extends modelo
{
    protected $table = 'sectores';
    protected $fillable = ["nombre","slug","parroquias_id"];
    protected $campos = [
    'nombre' => [
        'type' => 'text',
        'label' => 'Nombre',
        'placeholder' => 'Nombre del Sectores'
    ],
    'parroquias_id' => [
        'type' => 'select',
        'label' => 'Parroquias',
        'placeholder' => 'Parroquias del Sectores'
    ]
];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
       $this->campos['parroquias_id']['options'] = Parroquia::pluck('nombre', 'id');
        
    }

    
}