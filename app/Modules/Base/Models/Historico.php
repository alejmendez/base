<?php 

namespace App\Modules\Base\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model{
	protected $table = 'app_historico';
	protected $fillable = ['tabla', 'concepto', 'idregistro', 'usuario'];
}
