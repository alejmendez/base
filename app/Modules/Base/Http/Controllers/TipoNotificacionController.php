<?php

namespace App\Modules\Base\Http\Controllers;

//Controlador Padre
use App\Modules\Base\Http\Controllers\Controller;

//Dependencias
use DB;
use App\Http\Requests\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;

//Request
use App\Modules\Base\Http\Requests\TipoNotificacionRequest;

//Modelos
use App\Modules\Base\Models\TipoNotificacion;

class TipoNotificacionController extends Controller
{
    protected $titulo = 'Tipo Notificacion';

    public $js = [
        'TipoNotificacion'
    ];
    
    public $css = [
        'TipoNotificacion'
    ];

    public $librerias = [
        'datatables'
    ];

    public function index()
    {
        return $this->view('base::TipoNotificacion', [
            'TipoNotificacion' => new TipoNotificacion()
        ]);
    }

    public function nuevo()
    {
        $TipoNotificacion = new TipoNotificacion();
        return $this->view('base::TipoNotificacion', [
            'layouts' => 'base::layouts.popup',
            'TipoNotificacion' => $TipoNotificacion
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $TipoNotificacion = TipoNotificacion::find($id);
        return $this->view('base::TipoNotificacion', [
            'layouts' => 'base::layouts.popup',
            'TipoNotificacion' => $TipoNotificacion
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $TipoNotificacion = TipoNotificacion::withTrashed()->find($id);
        } else {
            $TipoNotificacion = TipoNotificacion::find($id);
        }

        if ($TipoNotificacion) {
            return array_merge($TipoNotificacion->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(TipoNotificacionRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $TipoNotificacion = $id == 0 ? new TipoNotificacion() : TipoNotificacion::find($id);

            $TipoNotificacion->fill($request->all());
            $TipoNotificacion->save();
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
            'id'    => $TipoNotificacion->id,
            'texto' => $TipoNotificacion->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            TipoNotificacion::destroy($id);
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
            TipoNotificacion::withTrashed()->find($id)->restore();
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
            TipoNotificacion::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = TipoNotificacion::select([
            'id', 'nombre', 'ruta', 'deleted_at'
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
}