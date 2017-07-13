<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

class Ciudades extends modelo
{
    protected $table = 'ciudades';
    protected $fillable = ["estados_id","nombre","capital"];
    protected $campos = [
        'estados_id' => [
            'type'        => 'select',
            'label'       => 'Estados',
            'placeholder' => 'Estados del Ciudades',
            'url'         => 'estados'
        ],
        'nombre' => [
            'type'        => 'text',
            'label'       => 'Nombre',
            'placeholder' => 'Nombre del Ciudades'
        ]
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);      
        $this->campos['estados_id']['options'] = Estados::pluck('nombre', 'id');
    }

    public function estados()
    {
        return $this->belongsTo('Modules\Base\Models\Estados', 'estados_id');
    }
}