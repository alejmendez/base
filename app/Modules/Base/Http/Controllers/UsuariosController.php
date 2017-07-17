<?php

namespace App\Modules\Base\Http\Controllers;

//Dependencias
use DB;
use URL;
use Yajra\Datatables\Datatables;

//Controlador Padre
use App\Modules\Base\Http\Controllers\Controller;

//Request
use App\Http\Requests\Request;
use App\Modules\Base\Http\Requests\UsuariosRequest;

//Modelos
use App\Modules\Base\Models\Usuario;

use App\Modules\Base\Models\Perfil;
use App\Modules\Base\Models\Menu;
use App\Modules\Base\Models\UsuarioPermisos;
use App\Modules\Base\Models\Personas;
use App\Modules\Base\Models\PersonasTelefono;
use App\Modules\Base\Models\PersonasCorreo;


class UsuariosController extends Controller {
	protected $titulo = 'Usuarios';

	public $js = ['Usuarios'];
	public $css = ['Usuarios'];

	public $librerias = [
		'alphanum', 
		'maskedinput', 
		'datatables', 
		'jstree',
		'bootstrap-select'
	];

	public function index() {	
		return $this->view('base::Usuarios',[
			'Personas' => new Personas(),
			'Personas_telefono' => new PersonasTelefono(),
			'Personas_correo' => new PersonasCorreo()
		]);
	}

	public function buscar(Request $request, $id) {
		if ($this->permisologia($this->ruta() . '/restaurar') || $this->permisologia($this->ruta() . '/destruir')){
			$usuario = Usuario::withTrashed()->find($id);
		}else{
			$usuario = Usuario::find($id);
			
		}
			$persona = Personas::find($usuario->personas_id);
		if ($usuario){
			$usuario->foto = URL::to("public/img/usuarios/" . $persona->foto);
			$permisos = $usuario->UsuarioPermisos->pluck('ruta');


			return array_merge($usuario->toArray(), [
				'permisos' => $permisos,
				'persona' => $persona,
				
				's' => 's',
				'msj' => trans('controller.buscar'),
			]);
		}

		return trans('controller.nobuscar');
	}

	protected function data($request){
		$foto = "user.png";
		
		if($file = $request->file('foto')){
			$foto = $request->usuario . '.' . $file->getClientOriginalExtension();

			$path = public_path('img/usuarios/');
			$file->move($path, $foto);
			chmod($path . $foto, 0777);
		}

		$data = $request->all();
		$data['foto'] = $foto;

		if($data['password'] == ""){
			unset($data['password']);
		}

		return $data;
	}
	
	public function guardar(UsuariosRequest $request, $id = 0) {
		
		DB::beginTransaction();
		try {
			$data = $this->data($request);
			if ($id === 0){
				$persona = Personas::where('dni',$request->dni)->get();

				if($persona->count() == 0){
					$persona = Personas::create([
						"tipo_persona_id" => $data['tipo_persona_id'],
						"dni" => $data['dni'],
						"nombres"=> $data['nombres'],
						"foto" => $data['foto']
					]);
					$data['personas_id'] = $persona['id'];
				}else{
					$persona->toArray();
					$data['personas_id'] = $persona[0]['id'];
				}	

				$telefono = PersonasTelefono::where('personas_id', $data['personas_id'])
				->where('principal', 1)->get();
				
				if($telefono->count() == 0){
					PersonasTelefono::create([
						"personas_id" => $data['personas_id'],
						"tipo_telefono_id" => $data['tipo_telefono_id'],
						"numero" => $data['numero'],
						"principal" => true
					]);
				}

				$correo = PersonasCorreo::where('personas_id', $data['personas_id'])
				->where('principal', 1)->get();
				
				if($correo->count() == 0){
					PersonasCorreo::create([
						"personas_id" => $data['personas_id'],
						"correo" => $data['cuenta'],
						"principal" => true
					]);
				}
				
				$usuario = Usuario::create($data);
				$id = $usuario->id;
			}else{
				$usuario = Usuario::find($id)->update($data);

				$usuario = Usuario::find($id);
				Personas::find($usuario->personas_id)->update($data);
			}
			
			$this->procesar_permisos($request, $id);
		} catch (Exception $e) {
			DB::rollback();
			return $e->errorInfo[2];
		}

		DB::commit();
		return [
			'id' => $usuario->id, 
			'texto' => $usuario->nombre, 
			's' => 's', 
			'msj' => trans('controller.incluir')
		];
	}

	protected function procesar_permisos($request, $id) {
		$permisos = explode(',', $request->input('permisos'));

		$permiso_perfil = UsuarioPermisos::where('usuario_id', $id)->delete();

		foreach ($permisos as $permiso) {
			$permiso = trim($permiso);

			UsuarioPermisos::create([
				'usuario_id' => $id,
				'ruta' => trim($permiso),
			]);
		}
	}

	public function eliminar(Request $request, $id = 0) {
		try {
			$usuario = Usuario::destroy($id);
		} catch (Exception $e) {
			return $e->errorInfo[2];
		}

		return ['s' => 's', 'msj' => trans('controller.eliminar')];
	}

	public function restaurar(Request $request, $id = 0) {
		try {
			Usuario::withTrashed()->find($id)->restore();
		} catch (Exception $e) {
			return $e->errorInfo[2];
		}

		return ['s' => 's', 'msj' => trans('controller.restaurar')];
	}

	public function destruir(Request $request, $id = 0) {
		try {
			Usuario::withTrashed()->find($id)->forceDelete();
		} catch (Exception $e) {
			return $e->errorInfo[2];
		}

		return ['s' => 's', 'msj' => trans('controller.destruir')];
	}

	public function perfiles() {
		return perfil::pluck('nombre', 'id');
	}

	public function arbol() {
		return menu::estructura(true);
	}

	public function datatable(Request $request) {
		$sql = Usuario::select('app_usuario.id', 'personas.dni', 'personas.nombres', 'app_usuario.usuario', 'app_usuario.deleted_at')
		->join('personas','personas.id','=','app_usuario.personas_id');

		if ($request->verSoloEliminados == 'true'){
			$sql->onlyTrashed();
		}elseif ($request->verEliminados == 'true'){
			$sql->withTrashed();
		}

		return Datatables::of($sql)
			->setRowId('id')
			->setRowClass(function ($registro) {
				return is_null($registro->deleted_at) ? '' : 'bg-red-thunderbird bg-font-red-thunderbird';
			})
			->make(true);
	}

	public function validar(Request $request){

		$persona = Personas::where('dni',$request->dato)->get();
		
		if($persona->count() == 0){

			return [
			's' => 'n'
			];
		}	
		$_persona = $persona->toArray();
		$telefono = PersonasTelefono::where('personas_id', $_persona[0]['id'])
			->where('principal', 1)->get();
		
		if($telefono->count() == 0){
			$telefono = 'n';
		}else{
			$telefono =	$telefono->toArray();
		}

		$correo = PersonasCorreo::where('personas_id', $_persona[0]['id'])
			->where('principal', 1)->get();
		
		if($correo->count() == 0){
			$correo = 'n';
		}else{
			$correo =	$correo->toArray();
		}

		return [
			'persona' => $_persona[0],
			'telefono'=> $telefono[0],
			'correo'  => $correo[0],
			's' => 's', 
			'msj' => trans('controller.incluir')
		];
	}
}