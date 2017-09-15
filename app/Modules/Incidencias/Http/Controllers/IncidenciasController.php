<?php

namespace App\Modules\Incidencias\Http\Controllers;

//Controlador Padre
use App\Modules\Incidencias\Http\Controllers\Controller;
use Image;
//Dependencias
use DB;
use Module;
use App\Http\Requests\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;

//Request
use App\Modules\Incidencias\Http\Requests\IncidenciasRequest;
//Modelos
use App\Modules\Incidencias\Models\Incidencias;
use App\Modules\Incidencias\Models\IncidenciasImagenes as Imagenes ;

class IncidenciasController extends Controller
{
    protected $titulo = 'Incidencias';

    public $js = [
        'Incidencias'
    ];
    
    public $css = [
        'Incidencias'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
        'jquery-ui',
        'jquery-ui-timepicker',
        'file-upload',
        'jcrop'
    ];

    public function index()
    {
        return $this->view('incidencias::Incidencias', [
            'Incidencias' => new Incidencias()
        ]);
    }

    public function nuevo()
    {
        $Incidencias = new Incidencias();
        return $this->view('incidencias::Incidencias', [
            'layouts' => 'base::layouts.popup',
            'Incidencias' => $Incidencias
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Incidencias = Incidencias::find($id);
        return $this->view('incidencias::Incidencias', [
            'layouts' => 'base::layouts.popup',
            'Incidencias' => $Incidencias
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Incidencias = Incidencias::withTrashed()->find($id);
        } else {
            $Incidencias = Incidencias::find($id);
        }

        if ($Incidencias) {
            return array_merge($Incidencias->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(IncidenciasRequest $request, $id = 0)
    {
        DB::beginTransaction();

   
        try{
            $Incidencias = $id == 0 ? new Incidencias() : Incidencias::find($id);
            $archivos = json_decode($request->archivos);
            $Incidencias->fill([
                'titulo'        =>  $request->titulo,
                'descripcion'   =>  $request->descripcion,
                'correo'        =>  $request->correo,
                'modulo'        =>  $request->modulo,
                'estatus_id'    =>  1,
                'app_usuario_id'=>  \Auth::user()->id,
                'app_perfil_id' =>  \Auth::user()->perfil_id,
            ]);

            $Incidencias->save();
            
            $this->guardarImagenes($archivos,  $Incidencias->id);

           /*  
            $Usuario = $id == 0 ? new Usuario() : Usuario::find($id);
            //dd(   $request->id);
            $Usuario->fill([
                'nombre'=> $request->nombre,
                'descripcion'=>$request->descripcion,
                'correo'=>$request->correo,
                'modulo'=> $request->modulo,
                'estatus_id'=> 1,
                'app_usuario_id'=>\Auth::user()->id,
                'app_perfil_id'=> \Auth::user()->perfil_id
            ]);
            $Usuario->save(); */
        } catch(QueryException $e) {
            DB::rollback();
            //return response()->json(['s' => 's', 'msj' => $e->getMessage()], 500);
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch(Exception $e) {
            DB::rollback();
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }
        DB::commit();

        return [
            'id'    => $Incidencias->id,
            'texto' => $Incidencias->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    protected function guardarImagenes($archivos,$id=0){
         foreach ($archivos as $archivo => $data) {
            if (!preg_match("/^(\d{4})\-(\d{2})\-([0-9a-z\.]+)\.(jpe?g|png)$/i", $archivo)) {
                continue;
            }

            $archivo = str_replace('-','/',$archivo);
           
            $imagenes=Imagenes::firstOrNew(array('url'=>$archivo));
            $imagenes->fill([
                'incidencias_id'=> $id

            ]);
            $imagenes->save();
        } 
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Incidencias::destroy($id);
        } catch (QueryException $e) {
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.eliminar')];
    }

    public function restaurar(Request $request, $id = 0)
    {
        try {
            Incidencias::withTrashed()->find($id)->restore();
        } catch (QueryException $e) {
           return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.restaurar')];
    }

    public function destruir(Request $request, $id = 0)
    {
        try {
            Incidencias::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Incidencias::select([
            'id', 'titulo', 'descripcion', 'app_usuario_id', 'app_perfil_id', 'estatus_id', 'correo', 'deleted_at'
        ]);

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

    public function modulo(){

         //$modulos = Module::all();
         //Estatus::pluck('nombre', 'id');
        $modulo = [];
        foreach (Module::all() as $key => $value) {
            $modulo[ $value->name] = $value->name;
        }
        
        return $modulo;
    } 

    
    public function subir(Request $request) {

       /* $validator = Validator::make($request->all(), [
            'files.*' => ['required', 'mimes:jpeg,jpg,png'],
        ]);

        if ($validator->fails()) {
            return 'Error de Validacion';
        }

        */

        $files = $request->file('files');
        $url = $this->ruta();
        $url = substr($url, 0, strlen($url) - 6);

        $rutaFecha = $this->getRuta();
        $ruta = public_path('archivos/incidencias/' . $rutaFecha);

        $respuesta = array( 
            'files' => array(),
        );

        foreach ($files as $file) {
            do {
                $nombre_archivo = $this->random_string() . '.' . $file->getClientOriginalExtension();
            } while (is_file($ruta . $nombre_archivo));

            $id = str_replace('/', '-', $rutaFecha . $nombre_archivo);

            $respuesta['files'][] = [
                'id' => $id,
                'name' => $nombre_archivo,
                'size' => $file->getSize(),
                'type' => $file->getMimeType(),
                //'url' => url('imagen/small/' . $rutaFecha . $nombre_archivo),
                'url' => url('public/archivos/incidencias/' . $rutaFecha . $nombre_archivo),
                'thumbnailUrl' => url('public/archivos/incidencias/' . $rutaFecha . $nombre_archivo),
                'deleteType' => 'DELETE',
                'deleteUrl' => url($url . '/eliminarimagen/' . $id),
                'data' => [
                    'cordenadas' => [],
                    'leyenda' => '',
                    'descripcion' => ''
                ]
            ];

            $mover = $file->move($ruta, $nombre_archivo);
        }

        return $respuesta;
    }

    protected function random_string($length = 20) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    public function puedepublicar(){
        return strtolower($this->usuario->super) === 's' || $this->permisologia('publicar');
        //return in_array($this->usuario->app_perfil_id, $this->perfiles_publicar);
    }

    protected function data($request) {
        if ($this->puedepublicar() &&
            $request->input(['published_at']) != '') {
            $data = $request->all();
        } else {
            $data = $request->except(['published_at']);
        }

        $data['contenido'] = strip_tags($data['contenido_html']);
        $data['app_usuario_id'] = $this->usuario->id;

        return $data;
    } 

    protected function getRuta() {
        return date('Y') . '/' . date('m') . '/';
    } 

}

