<?php

namespace App\Modules\Base\Http\Controllers\definiciones;

//Controlador Padre
use App\Modules\Base\Http\Controllers\Controller;

//Dependencias
use DB;
use App\Http\Requests\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;

//Request
use App\Modules\Base\Http\Requests\MunicipioRequest;

//Modelos
use App\Modules\Base\Models\Municipio;

class MunicipioController extends Controller
{
    protected $titulo = 'Municipio';

    public $js = [
        'Municipio'
    ];
    
    public $css = [
        'Municipio'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
    ];

    public function index()
    {
        return $this->view('base::Municipio', [
            'Municipio' => new Municipio()
        ]);
    }

    public function nuevo()
    {
        $Municipio = new Municipio();
        return $this->view('base::Municipio', [
            'layouts' => 'base::layouts.popup',
            'Municipio' => $Municipio
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Municipio = Municipio::find($id);
        return $this->view('base::Municipio', [
            'layouts' => 'base::layouts.popup',
            'Municipio' => $Municipio
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Municipio = Municipio::withTrashed()->find($id);
        } else {
            $Municipio = Municipio::find($id);
        }

        if ($Municipio) {
            return array_merge($Municipio->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(MunicipioRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Municipio = $id == 0 ? new Municipio() : Municipio::find($id);

            $Municipio->fill($request->all());
            $Municipio->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $Municipio->id,
            'texto' => $Municipio->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Municipio::destroy($id);
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
            Municipio::withTrashed()->find($id)->restore();
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
            Municipio::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Municipio::select([
            'municipios.id', 'estados.nombre as estado', 'municipios.nombre', 'municipios.deleted_at'
        ])->join('estados', 'estados.id','=', 'municipios.estados_id');

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