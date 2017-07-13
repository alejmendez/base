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
use App\Modules\Base\Http\Requests\CiudadesRequest;

//Modelos
use App\Modules\Base\Models\Ciudades;

class CiudadesController extends Controller
{
    protected $titulo = 'Ciudades';

    public $js = [
        'Ciudades'
    ];
    
    public $css = [
        'Ciudades'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
    ];

    public function index()
    {
        return $this->view('base::Ciudades', [
            'Ciudades' => new Ciudades()
        ]);
    }

    public function nuevo()
    {
        $Ciudades = new Ciudades();
        return $this->view('base::Ciudades', [
            'layouts' => 'base::layouts.popup',
            'Ciudades' => $Ciudades
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Ciudades = Ciudades::find($id);
        return $this->view('base::Ciudades', [
            'layouts' => 'base::layouts.popup',
            'Ciudades' => $Ciudades
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Ciudades = Ciudades::withTrashed()->find($id);
        } else {
            $Ciudades = Ciudades::find($id);
        }

        if ($Ciudades) {
            return array_merge($Ciudades->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(CiudadesRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Ciudades = $id == 0 ? new Ciudades() : Ciudades::find($id);

            $Ciudades->fill($request->all());
            $Ciudades->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $Ciudades->id,
            'texto' => $Ciudades->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Ciudades::destroy($id);
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
            Ciudades::withTrashed()->find($id)->restore();
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
            Ciudades::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Ciudades::select([
            'ciudades.id', 'estados.nombre as estado', 'ciudades.nombre', 'ciudades.deleted_at'
        ])->join('estados', 'estados.id','=', 'ciudades.estados_id');

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