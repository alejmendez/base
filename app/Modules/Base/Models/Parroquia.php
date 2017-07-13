<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

class Parroquia extends modelo
{
    protected $table = 'parroquias';
    protected $fillable = ["nombre","municipios_id"];
    protected $campos = [
        'municipios_id' => [
            'type'        => 'select',
            'label'       => 'Municipios',
            'placeholder' => 'Seleccione un Municipio',
            'url'         => 'municipio'
        ],
        'nombre' => [
            'type'        => 'text',
            'label'       => 'Nombre',
            'placeholder' => 'Nombre del Parroquia'
        ],
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->campos['municipios_id']['options'] = Municipio::pluck('nombre', 'id');
    }

    public function municipio()
    {
        return $this->belongsTo('Modules\Base\Models\Municipio', 'municipios_id');
    }

    public function sector()
    {
        return $this->hasMany('Modules\Base\Models\sector', 'parroquias_id');
    }
}