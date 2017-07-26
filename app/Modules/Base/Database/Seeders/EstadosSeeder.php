<?php 

namespace App\Modules\Base\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

//modelo(s)
use  App\Modules\Base\Models\Estados;

class EstadosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$estados = [
			['VE-X', 'Amazonas'],
			['VE-B', 'Anzoátegui'],
			['VE-C', 'Apure'],
			['VE-D', 'Aragua'],
			['VE-E', 'Barinas'],
			['VE-F', 'Bolívar'],
			['VE-G', 'Carabobo'],
			['VE-H', 'Cojedes'],
			['VE-Y', 'Delta Amacuro'],
			['VE-I', 'Falcón'],
			['VE-J', 'Guárico'],
			['VE-K', 'Lara'],
			['VE-L', 'Mérida'],
			['VE-M', 'Miranda'],
			['VE-N', 'Monagas'],
			['VE-O', 'Nueva Esparta'],
			['VE-P', 'Portuguesa'],
			['VE-R', 'Sucre'],
			['VE-S', 'Táchira'],
			['VE-T', 'Trujillo'],
			['VE-W', 'Vargas'],
			['VE-U', 'Yaracuy'],
			['VE-V', 'Zulia'],
			['VE-A', 'Distrito Capital'],
			['VE-Z', 'Dependencias Federales']
		];

		DB::beginTransaction();
		try{
			foreach ($estados as $estado) {
				Estados::create([
					'nombre' 		=> $estado[1],
					'iso_3166-2' 	=> $estado[0]
				]);
			}
		}catch(Exception $e){
			DB::rollback();
			return "Error ";
		}
		DB::commit();
	}
}