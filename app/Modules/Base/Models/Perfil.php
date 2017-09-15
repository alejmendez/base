<?php 

namespace App\Modules\Base\Models;
use App\Modules\Base\Models\Modelo;

class Perfil extends Modelo{
	protected $table = 'app_perfil';
	protected $fillable = ['nombre'];

	public function permisos(){
		return $this->hasMany('App\Modules\Base\Models\PerfilesPermisos', 'perfil_id');
		
		// hasMany = "tiene muchas" | hace relacion desde el maestro hasta el detalle
		//return $this->hasMany('App\Modules\Base\Models\App_usuario_permisos');
	}

	public function usuarios(){
		return $this->hasMany('App\Modules\Base\Models\Usuario', 'perfil_id');
		
		// hasMany = "tiene muchas" | hace relacion desde el maestro hasta el detalle
		//return $this->hasMany('App\Modules\Base\Models\App_usuario_permisos');
	}
}
