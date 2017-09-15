<?php

namespace App\Modules\Incidencias\Http\Controllers;

//Controlador Padre
use App\Modules\Incidencias\Http\Controllers\Controller;

//Dependencias
use DB;
use App\Http\Requests\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;

//Request
use App\Modules\Incidencias\Http\Requests\EstatusRequest;

//Modelos
use App\Modules\Incidencias\Models\Estatus;

class EstatusController extends Controller
{
    protected $titulo = 'Estatus';

    public $js = [
        'Estatus'
    ];
    
    public $css = [
        'Estatus'
    ];

    public $librerias = [
        'datatables'
    ];

    public function index()
    {
        return $this->view('incidencias::Estatus', [
            'Estatus' => new Estatus()
        ]);
    }

    public function nuevo()
    {
        $Estatus = new Estatus();
        return $this->view('incidencias::Estatus', [
            'layouts' => 'base::layouts.popup',
            'Estatus' => $Estatus
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Estatus = Estatus::find($id);
        return $this->view('incidencias::Estatus', [
            'layouts' => 'base::layouts.popup',
            'Estatus' => $Estatus
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Estatus = Estatus::withTrashed()->find($id);
        } else {
            $Estatus = Estatus::find($id);
        }

        if ($Estatus) {
            return array_merge($Estatus->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(EstatusRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Estatus = $id == 0 ? new Estatus() : Estatus::find($id);

            $Estatus->fill($request->all());
            $Estatus->save();
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
            'id'    => $Estatus->id,
            'texto' => $Estatus->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Estatus::destroy($id);
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
            Estatus::withTrashed()->find($id)->restore();
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
            Estatus::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return ['s' => 'n', 'msj' => $e->getMessage()];
        } catch (Exception $e) {
            return ['s' => 'n', 'msj' => $e->errorInfo[2]];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Estatus::select([
            'id', 'nombre', 'deleted_at'
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