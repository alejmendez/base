<?php

namespace App\Modules\Base\Http\Controllers;

//Controlador Padre
use App\Modules\Base\Http\Controllers\Controller;

//Dependencias
use DB;
use App\Http\Requests\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
//Request
use App\Modules\Base\Http\Requests\PersonasRequest;

//Modelos
use App\Modules\Base\Models\Personas;
use App\Modules\Base\Models\PersonasDetalles;
use App\Modules\Base\Models\PersonasDireccion;
use App\Modules\Base\Models\PersonasBancos;
use App\Modules\Base\Models\PersonasTelefono;
use App\Modules\Base\Models\PersonasCorreo;

use App\Modules\Base\Models\TipoTelefono;

use App\Modules\Base\Models\Estados;
use App\Modules\Base\Models\Municipio;
use App\Modules\Base\Models\Parroquia;
use App\Modules\Base\Models\Ciudades;
use App\Modules\Base\Models\Sector;


class PersonasController extends Controller
{
    protected $titulo = 'Personas';

    public $js = [
        'Personas'
    ];
    
    public $css = [
        'Personas'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
        'template',
        'jquery-ui',
        'jquery-ui-timepicker'
    ];

    public function index()
    {
        return $this->view('base::Personas', [
            'Personas' => new Personas(),
            'Personas_detalles' => new PersonasDetalles(),
            'Personas_direccion' => new PersonasDireccion()
        ]);
    }

    public function nuevo(Request $request)
    {
        //dd('hola');
        $Personas  = Personas::firstOrNew([
            'dni' => $request->dni
        ]);
        //$Personas = new Personas();
        
        //$Personas->campos['tipo_persona_id']['disabled'] = 'disabled';
        unset($Personas->campos['tipo_persona_id']['url']);

        $Personas->campos['dni']['value'] = $request->dni;
        $Personas->campos['dni']['readonly'] = 'readonly';

        return $this->view('base::Personas', [
            'layouts'            => 'base::layouts.popup',
            'Personas'           => $Personas,
            'Personas_detalles'  => new PersonasDetalles(),
            'Personas_direccion' => new PersonasDireccion()
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Personas = Personas::find($id);
        return $this->view('base::Personas', [
            'layouts'  => 'base::layouts.popup',
            'Personas' => $Personas
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
       
        $Personas = Personas::with('personadetalle', 'personadireccion')->find($id);
        
            $datos = [
                "id"                => $id,
                "tipo_persona_id"   => $Personas->tipo_persona_id,
                "dni"               => $Personas->dni,
                "nombres"           => $Personas->nombres,
                "foto"              => $Personas->foto,    
            ];


            if(!is_null($Personas->personadireccion)){
                
                $datos = array_merge($datos, [
                    "estados_id"        => $Personas->personadireccion->estados_id,
                    "ciudades_id"       => $Personas->personadireccion->ciudades_id,
                    "municipios_id"      => $Personas->personadireccion->municipios_id,
                    "parroquias_id"      => $Personas->personadireccion->parroquias_id,
                    "sectores_id"         => $Personas->personadireccion->sectores_id,
                    "direccion"         => $Personas->personadireccion->direccion,
                    
                ]);
            }
            if(!is_null($Personas->personadetalle)){
                
                $datos = array_merge($datos, [
                    "profesion_id"      => $Personas->personadetalle->profesion_id,
                    "sexo"              => $Personas->personadetalle->sexo,
                    "fecha_nacimiento"  => $Personas->personadetalle->fecha_nacimiento
                ]);
            }

          
        if ($Personas) {
            return array_merge($datos, [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    protected function foto($request){

        $foto = "user.png";
        
        if($file = $request->file('foto')){
            $foto =  $this->random_string(). '.' .$file->getClientOriginalExtension();

            $path = public_path('img/usuarios/');
            $file->move($path, $foto);
            chmod($path . $foto, 0777);
        }        

        return $foto;
    }

    protected function random_string($length = 20) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }


    protected function personas($request, $id){
    //procesa los datos antes de guardar
        
        $persona = [
            "tipo_persona_id" => $request->tipo_persona_id,
            "dni"             => $request->dni,
            "nombres"         => $request->nombres
        ];

       if($request->foto != ''|| $id !=0){
         $foto = $this->foto($request);
         $persona['foto'] = $foto;
       }
        return $persona;
    }

    public function guardar(PersonasRequest $request, $id = 0)
    {
       
      
        DB::beginTransaction();
        try{
                 
            $Personas = $id == 0 ? new Personas() : Personas::find($id);

            $datos = $this->personas($request, $id);

            $Personas->fill($datos);
            $Personas->save();

            if ($request->tipo_persona_id == 1 || $request->tipo_persona_id == 2) {
                PersonasDetalles::updateOrCreate(
                    ['personas_id' => $Personas->id],
                    ['profesion_id' => $request->profesion_id,
                     'sexo'=> $request->sexo,
                     'fecha_nacimiento'=> $request->fecha_nacimiento
                ]);     
            }

            if($request->estados_id !=''){
                PersonasDireccion::updateOrCreate(
                    ['personas_id' => $Personas->id],
                    [
                        "estados_id"    => $request->estados_id,
                        "ciudades_id"   => $request->ciudades_id,
                        "municipios_id"  => $request->municipios_id,
                        "parroquias_id"  => $request->parroquias_id,
                        "sectores_id"    => $request->sectores_id,
                        "direccion"     => $request->direccion
                    ]
                );  
            }

            if($request->tipo_telefono[0] != '' ){

                $this->telefono_actulizar($request->all(), $Personas->id);
            } 

            if($request->correo[0] != '' ){
                $this->correo_actulizar($request->all(), $Personas->id);
            }

        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $Personas->id,
            'texto' => $Personas->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function telefono_actulizar($request, $id){
        DB::beginTransaction();
        try { 

            $datos = [];
            foreach ($request['tipo_telefono'] as $_id => $bancos) {
                if($bancos==" "){
                    continue;
                }

                $datos= [
                    'personas_id'       => $id,
                    'principal'         => $request['principal_tlf'][$_id],
                    'tipo_telefono_id'  => $request['tipo_telefono'][$_id],
                    'numero'            => $request['numero'][$_id]
                ];
                
                if($request['id_telefonos'][$_id]==0){
                    PersonasTelefono::create($datos);
                }else{
                    PersonasTelefono::find($request['id_telefonos'][$_id])->update($datos);
                } 
            }
          

        } catch (Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }

        DB::commit();

        return ['s' => 's', 'msj' => trans('controller.incluir')];
    }
      
    public function correo_actulizar($request, $id){
        DB::beginTransaction();
        try { 

            $datos = [];
            foreach ($request['correo'] as $_id => $bancos) {
                if($bancos==" "){
                    continue;
                }

                $datos= [
                    'personas_id'  => $id,
                    'principal'    => $request['principal_correo'][$_id],
                    'correo'       => $request['correo'][$_id]
                ];
                
                if($request['id_correo'][$_id]==0){
                    PersonasCorreo::create($datos);
                }else{
                    PersonasCorreo::find($request['id_correo'][$_id])->update($datos);
                } 
            }
          

        } catch (Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }

        DB::commit();

        return ['s' => 's', 'msj' => trans('controller.incluir')];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Personas::destroy($id);
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.eliminar')];
    }

    public function restaurar(Request $request, $id = 0)
    {
        try {
            Personas::withTrashed()->find($id)->restore();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.restaurar')];
    }

    public function destruir(Request $request, $id = 0)
    {
        try {
            Personas::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function ciudades(Request $request){
        $sql = Ciudades::where('estados_id', $request->id)
                    ->pluck('nombre','id')
                    ->toArray();

        $salida = ['s' => 'n' , 'msj'=> 'el estado no Contiene ciudades'];
        
        if($sql){
            $salida = ['s' => 's' , 'msj'=> 'Ciudades encontrados', 'ciudades_id'=> $sql];
        }               
        
        return $salida;
    } 
    
    public function municipios(Request $request){
        $sql = Municipio::where('estados_id', $request->id)
                    ->pluck('nombre','id')
                    ->toArray();

        $salida = ['s' => 'n' , 'msj'=> 'el estado no Contiene municipios'];
        
        if($sql){
            $salida = ['s' => 's' , 'msj'=> 'Municipios encontrados', 'municipios_id'=> $sql];
        }               
        
        return $salida;
    } 

    public function parroquias(Request $request){
        $sql = Parroquia::where('municipios_id', $request->id)
                    ->pluck('nombre','id')
                    ->toArray();

        $salida = ['s' => 'n' , 'msj'=> 'el municipio no Contiene parroquias'];
        
        if($sql){
            $salida = ['s' => 's' , 'msj'=> 'Paroquias encontrados', 'parroquias_id'=> $sql];
        }               
        
        return $salida;
    } 
    
    public function sectores(Request $request){
        $sql = Sector::where('parroquias_id', $request->id)
                    ->pluck('nombre','id')
                    ->toArray();

        $salida = ['s' => 'n' , 'msj'=> 'La parroquia no Contiene sectores'];
        
        if($sql){
            $salida = ['s' => 's' , 'msj'=> 'Sectores encontrados', 'sectores_id'=> $sql];
        }               
        
        return $salida;
    }

    public function bancos(){
        return Bancos::pluck('nombre','id');
    }
    public function tipocuenta(){
        return BancoTipoCuenta::pluck('nombre','id');
    } 
    public function tipotelefono(){
        return TipoTelefono::pluck('nombre','id');
    }

    public function personasbancos(Request $request){
        $bancos = PersonasBancos::where('personas_id', $request->id)->get();
        return ['datos' =>$bancos->toArray()];
    }
    public function personastelefono(Request $request){
        $telefonos = PersonasTelefono::where('personas_id', $request->id)->get();
        return ['datos' =>$telefonos->toArray()];
    } 
    public function principal(){
        $datos[]='no';
        $datos[]='si';
        return $datos;
    } 
    public function personascorreos(Request $request){
        $correos = PersonasCorreo::where('personas_id', $request->id)->get();
        return ['datos' =>$correos->toArray()];
    }
    public function datatable(Request $request)
    {
        $sql = Personas::select([
            'personas.id', 'tipo_persona.nombre as tipo_persona', 'personas.dni', 'personas.nombres', 'personas.deleted_at'
        ])->join('tipo_persona', 'tipo_persona.id','=','personas.tipo_persona_id');

        if ($request->verSoloEliminados == 'true') {
            $sql->onlyTrashed();
        } elseif ($request->verEliminados == 'true') {
            $sql->withTrashed();
        }

        return Datatables::of($sql)
            ->setRowId('id')
            ->setRowClass(function ($registro) {
                return is_null($registro->deleted_at) ? '' : 'bg-red-thunderbird bg-font-red-thunderbird';
            })
            ->make(true);
    }
}