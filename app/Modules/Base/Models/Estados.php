<?php

namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;



class Estados extends modelo
{
    protected $table = 'estados';
    protected $fillable = ["nombre","iso_3166-2"];
    protected $campos = [
    'nombre' => [
        'type' => 'text',
        'label' => 'Nombre',
        'placeholder' => 'Nombre del Estados'
    ],
    'iso_3166-2' => [
        'type' => 'text',
        'label' => 'Iso 3166-2',
        'placeholder' => 'Iso 3166-2 del Estados'
    ]
];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
    }
    public function ciudades(){
        // hasMany = "tiene muchas" | hace relacion desde el maestro hasta el detalle
        return $this->hasMany('Modules\Base\Models\Ciudades', 'estados_id');
    }
    
    public function municipio(){
        // hasMany = "tiene muchas" | hace relacion desde el maestro hasta el detalle
        return $this->hasMany('Modules\Base\Models\Municipio', 'estados_id');
    }
    
}