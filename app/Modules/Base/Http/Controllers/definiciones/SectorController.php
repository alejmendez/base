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
use App\Modules\Base\Http\Requests\SectorRequest;

//Modelos
use App\Modules\Base\Models\Sector;

class SectorController extends Controller
{
    protected $titulo = 'Sector';

    public $js = [
        'Sector'
    ];
    
    public $css = [
        'Sector'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
    ];

    public function index()
    {
        return $this->view('base::Sector', [
            'Sector' => new Sector()
        ]);
    }

    public function nuevo()
    {
        $Sector = new Sector();
        return $this->view('base::Sector', [
            'layouts' => 'base::layouts.popup',
            'Sector' => $Sector
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Sector = Sector::find($id);
        return $this->view('base::Sector', [
            'layouts' => 'base::layouts.popup',
            'Sector' => $Sector
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Sector = Sector::withTrashed()->find($id);
        } else {
            $Sector = Sector::find($id);
        }

        if ($Sector) {
            return array_merge($Sector->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(SectorRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Sector = $id == 0 ? new Sector() : Sector::find($id);
            $datos = $request->all();
            $datos['slug'] = str_slug($request->nombre, '-');
            $Sector->fill($datos);
            $Sector->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $Sector->id,
            'texto' => $Sector->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Sector::destroy($id);
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
            Sector::withTrashed()->find($id)->restore();
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
            Sector::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Sector::select([
            'sectores.id', 'sectores.nombre', 'parroquias.nombre as parroquias', 'sectores.deleted_at'
        ])->join('parroquias', 'parroquias.id','=','sectores.parroquias_id');

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