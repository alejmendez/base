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
use App\Modules\Base\Http\Requests\TipoPersonaRequest;

//Modelos
use App\Modules\Base\Models\TipoPersona;

class TipoPersonaController extends Controller
{
    protected $titulo = 'Tipo Persona';

    public $js = [
        'TipoPersona'
    ];
    
    public $css = [
        'TipoPersona'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
    ];

    public function index()
    {
        return $this->view('base::TipoPersona', [
            'TipoPersona' => new TipoPersona()
        ]);
    }

    public function nuevo()
    {
        $TipoPersona = new TipoPersona();
        return $this->view('base::TipoPersona', [
            'layouts' => 'base::layouts.popup',
            'TipoPersona' => $TipoPersona
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $TipoPersona = TipoPersona::find($id);
        return $this->view('base::TipoPersona', [
            'layouts' => 'base::layouts.popup',
            'TipoPersona' => $TipoPersona
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $TipoPersona = TipoPersona::withTrashed()->find($id);
        } else {
            $TipoPersona = TipoPersona::find($id);
        }

        if ($TipoPersona) {
            return array_merge($TipoPersona->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(TipoPersonaRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $TipoPersona = $id == 0 ? new TipoPersona() : TipoPersona::find($id);

            $TipoPersona->fill($request->all());
            $TipoPersona->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $TipoPersona->id,
            'texto' => $TipoPersona->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            TipoPersona::destroy($id);
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
            TipoPersona::withTrashed()->find($id)->restore();
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
            TipoPersona::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = TipoPersona::select([
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