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
use App\Modules\Base\Http\Requests\EstadosRequest;

//Modelos
use App\Modules\Base\Models\Estados;

class EstadosController extends Controller
{
    protected $titulo = 'Estados';

    public $js = [
        'Estados'
    ];
    
    public $css = [
        'Estados'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
    ];

    public function index()
    {
        return $this->view('base::Estados', [
            'Estados' => new Estados()
        ]);
    }

    public function nuevo()
    {
        $Estados = new Estados();
        return $this->view('base::Estados', [
            'layouts' => 'base::layouts.popup',
            'Estados' => $Estados
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Estados = Estados::find($id);
        return $this->view('base::Estados', [
            'layouts' => 'base::layouts.popup',
            'Estados' => $Estados
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Estados = Estados::withTrashed()->find($id);
        } else {
            $Estados = Estados::find($id);
        }

        if ($Estados) {
            return array_merge($Estados->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(EstadosRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Estados = $id == 0 ? new Estados() : Estados::find($id);

            $Estados->fill($request->all());
            $Estados->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $Estados->id,
            'texto' => $Estados->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Estados::destroy($id);
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
            Estados::withTrashed()->find($id)->restore();
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
            Estados::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Estados::select([
            'id', 'nombre', 'iso_3166-2', 'deleted_at'
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