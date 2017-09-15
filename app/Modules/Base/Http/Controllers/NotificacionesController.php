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
use App\Modules\Base\Http\Requests\NotificacionesRequest;

//Modelos
use App\Modules\Base\Models\Notificaciones;

class NotificacionesController extends Controller
{
    protected $titulo = 'Notificaciones';

    public $js = [
        'Notificaciones'
    ];
    
    public $css = [
        'Notificaciones'
    ];

    public $librerias = [
        'datatables'
    ];

    public function index()
    {
        return $this->view('base::Notificaciones', [
            'Notificaciones' => new Notificaciones()
        ]);
    }

    public function nuevo()
    {
        $Notificaciones = new Notificaciones();
        return $this->view('base::Notificaciones', [
            'layouts' => 'base::layouts.popup',
            'Notificaciones' => $Notificaciones
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Notificaciones = Notificaciones::find($id);
        return $this->view('base::Notificaciones', [
            'layouts' => 'base::layouts.popup',
            'Notificaciones' => $Notificaciones
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Notificaciones = Notificaciones::withTrashed()->find($id);
        } else {
            $Notificaciones = Notificaciones::find($id);
        }

        if ($Notificaciones) {
            return array_merge($Notificaciones->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(NotificacionesRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Notificaciones = $id == 0 ? new Notificaciones() : Notificaciones::find($id);

            $Notificaciones->fill($request->all());
            $Notificaciones->save();
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
            'id'    => $Notificaciones->id,
            'texto' => $Notificaciones->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Notificaciones::destroy($id);
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
            Notificaciones::withTrashed()->find($id)->restore();
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
            Notificaciones::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Notificaciones::select([
            'id', 'usuario_id', 'enviado_id', 'mensaje_id', 'operacion_id', 'visto', 'tipo_notificacion_id', 'nuevo', 'nuevo2', 'deleted_at'
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