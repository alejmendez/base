<?php
namespace App\Modules\Base\Models;

use App\Modules\Base\Models\Modelo;

use Carbon\Carbon;


class PersonasDetalles extends modelo
{
    protected $table = 'personas_detalles';
    protected $fillable = ["personas_id","profesion_id","sexo","fecha_nacimiento"];
    protected $campos = [
        'profesion_id' => [
            'type'       => 'select',
            'label'      => 'Profesion',
            'url'        => 'personas/profesion',  
            'cont_class' => 'form-group col-md-4' 
        ],
        'sexo' => [
            'type'       => 'select',
            'label'      => 'Sexo',
            'cont_class' => 'form-group col-md-4',
            'options'    =>[
                'm' => 'Masculino',
                'f' => 'Femenino'
            ] 
        ],
        'fecha_nacimiento' => [
            'type'        => 'text',
            'label'       => 'Fecha Nacimiento',
            'placeholder' => 'Fecha Nacimiento del Personas Detalles',
            'cont_class'  => 'form-group col-md-4'
        ]
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->campos['profesion_id']['options'] = Profesion::pluck('nombre', 'id');
    }

    public function setFechaNacimientoAttribute($value)
    {
        // 2016-06-27
       
        $formato = 'd/m/Y';
        if (preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $value)){
            $formato = 'Y-m-d';
        }
        
        $this->attributes['fecha_nacimiento'] = Carbon::createFromFormat($formato, $value);
    }
    
    public function getFechaNacimientoAttribute($value){
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function profesion()
    {
        return $this->belongsTo('App\Modules\Base\Models\Profesion', 'profesion_id');
    } 

    public function personas()
    {
        return $this->belongsTo('App\Modules\Base\Models\Persona', 'personas_id');
    }
}