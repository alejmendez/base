<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

class Municipio extends modelo
{
    protected $table = 'municipios';
    protected $fillable = ["estados_id","nombre"];
    protected $campos = [
        'estados_id' => [
            'type'        => 'select',
            'label'       => 'Estados',
            'placeholder' => '- Seleccione un Estado',
            'url'         => 'estados'
        ],
        'nombre' => [
            'type'        => 'text',
            'label'       => 'Nombre',
            'placeholder' => 'Nombre del Municipio'
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

    public function parroquia()
    {
        return $this->hasMany('Modules\Base\Models\Parroquia', 'municipio_id');
    }
}