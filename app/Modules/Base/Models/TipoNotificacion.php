<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;



class TipoNotificacion extends Modelo
{
    protected $table = 'tipo_notificacion';
    protected $fillable = ["nombre","ruta"];
    protected $campos = [
    'nombre' => [
        'type' => 'text',
        'label' => 'Nombre',
        'placeholder' => 'Nombre del Tipo Notificacion'
    ],
    'ruta' => [
        'type' => 'text',
        'label' => 'Ruta',
        'placeholder' => 'Ruta del Tipo Notificacion'
    ]
];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
    }

    
}