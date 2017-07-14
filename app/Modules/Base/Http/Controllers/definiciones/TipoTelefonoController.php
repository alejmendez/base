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
use App\Modules\Base\Http\Requests\TipoTelefonoRequest;

//Modelos
use App\Modules\Base\Models\TipoTelefono;

class TipoTelefonoController extends Controller
{
    protected $titulo = 'Tipo Telefono';

    public $js = [
        'TipoTelefono'
    ];
    
    public $css = [
        'TipoTelefono'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
    ];

    public function index()
    {
        return $this->view('base::TipoTelefono', [
            'TipoTelefono' => new TipoTelefono()
        ]);
    }

    public function nuevo()
    {
        $TipoTelefono = new TipoTelefono();
        return $this->view('base::TipoTelefono', [
            'layouts' => 'base::layouts.popup',
            'TipoTelefono' => $TipoTelefono
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $TipoTelefono = TipoTelefono::find($id);
        return $this->view('base::TipoTelefono', [
            'layouts' => 'base::layouts.popup',
            'TipoTelefono' => $TipoTelefono
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $TipoTelefono = TipoTelefono::withTrashed()->find($id);
        } else {
            $TipoTelefono = TipoTelefono::find($id);
        }

        if ($TipoTelefono) {
            return array_merge($TipoTelefono->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(TipoTelefonoRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $TipoTelefono = $id == 0 ? new TipoTelefono() : TipoTelefono::find($id);

            $TipoTelefono->fill($request->all());
            $TipoTelefono->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $TipoTelefono->id,
            'texto' => $TipoTelefono->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            TipoTelefono::destroy($id);
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
            TipoTelefono::withTrashed()->find($id)->restore();
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
            TipoTelefono::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = TipoTelefono::select([
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