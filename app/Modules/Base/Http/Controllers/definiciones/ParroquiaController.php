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
use App\Modules\Base\Http\Requests\ParroquiaRequest;

//Modelos
use App\Modules\Base\Models\Parroquia;

class ParroquiaController extends Controller
{
    protected $titulo = 'Parroquia';

    public $js = [
        'Parroquia'
    ];
    
    public $css = [
        'Parroquia'
    ];

    public $librerias = [
        'alphanum',
        'maskedinput',
        'datatables',
    ];

    public function index()
    {
        return $this->view('base::Parroquia', [
            'Parroquia' => new Parroquia()
        ]);
    }

    public function nuevo()
    {
        $Parroquia = new Parroquia();
        return $this->view('base::Parroquia', [
            'layouts' => 'base::layouts.popup',
            'Parroquia' => $Parroquia
        ]);
    }

    public function cambiar(Request $request, $id = 0)
    {
        $Parroquia = Parroquia::find($id);
        return $this->view('base::Parroquia', [
            'layouts' => 'base::layouts.popup',
            'Parroquia' => $Parroquia
        ]);
    }

    public function buscar(Request $request, $id = 0)
    {
        if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')) {
            $Parroquia = Parroquia::withTrashed()->find($id);
        } else {
            $Parroquia = Parroquia::find($id);
        }

        if ($Parroquia) {
            return array_merge($Parroquia->toArray(), [
                's' => 's',
                'msj' => trans('controller.buscar')
            ]);
        }

        return trans('controller.nobuscar');
    }

    public function guardar(ParroquiaRequest $request, $id = 0)
    {
        DB::beginTransaction();
        try{
            $Parroquia = $id == 0 ? new Parroquia() : Parroquia::find($id);

            $Parroquia->fill($request->all());
            $Parroquia->save();
        } catch(QueryException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch(Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }
        DB::commit();

        return [
            'id'    => $Parroquia->id,
            'texto' => $Parroquia->nombre,
            's'     => 's',
            'msj'   => trans('controller.incluir')
        ];
    }

    public function eliminar(Request $request, $id = 0)
    {
        try{
            Parroquia::destroy($id);
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
            Parroquia::withTrashed()->find($id)->restore();
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
            Parroquia::withTrashed()->find($id)->forceDelete();
        } catch (QueryException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->errorInfo[2];
        }

        return ['s' => 's', 'msj' => trans('controller.destruir')];
    }

    public function datatable(Request $request)
    {
        $sql = Parroquia::select([
            'parroquias.id', 'parroquias.nombre', 'municipios.nombre as municipios', 'parroquias.deleted_at'
        ])->join('municipios', 'municipios.id','=', 'parroquias.municipios_id');

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