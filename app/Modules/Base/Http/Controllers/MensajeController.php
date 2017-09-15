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
use App\Modules\Base\Http\Requests\MensajeRequest;

//Modelos
use App\Modules\Base\Models\Mensaje;

class MensajeController extends Controller
{
    protected $titulo = 'Mensaje';

    public $js = [
        'Mensaje'
    ];
    
    public $css = [
        'Mensaje'
    ];

    public $librerias = [
        'datatables'
    ];

    public function index()
    {
        return $this->view('base::Mensaje', [
            'Mensaje' => new Mensaje()
        ]);
    }

    public function nuevo()
    {
        $Mensaje = new Mensaje();
        return $this->view('base::Mensaje', [
            'layouts' => 'base::layouts.popup',
            'Mensaje' => $Mensaje
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Mensaje = Mensaje::find($id);
        return $this->view('base::Mensaje', [
            'layouts' => 'base::layouts.popup',
            'Mensaje' => $Mensaje
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Mensaje = Mensaje::withTrashed()->find($id);
        } else {
            $Mensaje = Mensaje::find($id);
        }

        if ($Mensaje) {
            return array_merge($Mensaje->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(MensajeRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Mensaje = $id == 0 ? new Mensaje() : Mensaje::find($id);

            $Mensaje->fill($request->all());
            $Mensaje->save();
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
            'id'    => $Mensaje->id,
            'texto' => $Mensaje->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Mensaje::destroy($id);
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
            Mensaje::withTrashed()->find($id)->restore();
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
            Mensaje::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Mensaje::select([
            'id', 'mensaje', 'deleted_at'
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