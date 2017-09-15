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
use App\Modules\Base\Http\Requests\ProfesionRequest;

//Modelos
use App\Modules\Base\Models\Profesion;

class ProfesionController extends Controller
{
    protected $titulo = 'Profesion';

    public $js = [
        'Profesion'
    ];
    
    public $css = [
        'Profesion'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
    ];

    public function index()
    {
        return $this->view('base::Profesion', [
            'Profesion' => new Profesion()
        ]);
    }

    public function nuevo()
    {
        $Profesion = new Profesion();
        return $this->view('base::Profesion', [
            'layouts' => 'base::layouts.popup',
            'Profesion' => $Profesion
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Profesion = Profesion::find($id);
        return $this->view('base::Profesion', [
            'layouts' => 'base::layouts.popup',
            'Profesion' => $Profesion
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Profesion = Profesion::withTrashed()->find($id);
        } else {
            $Profesion = Profesion::find($id);
        }

        if ($Profesion) {
            return array_merge($Profesion->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(ProfesionRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Profesion = $id == 0 ? new Profesion() : Profesion::find($id);
            $datos = $request->all();
            $datos['slug'] = str_slug($request->nombre, '-');
            $Profesion->fill($datos);
            $Profesion->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $Profesion->id,
            'texto' => $Profesion->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Profesion::destroy($id);
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
            Profesion::withTrashed()->find($id)->restore();
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
            Profesion::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Profesion::select([
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