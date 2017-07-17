<?php

namespace App\Modules\Base\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Base\Models\Configuracion;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$configuraciones = [
			'logo'           => 'logo.png',
			'login_logo'     => 'login_logo.png',
			'nombre'         => 'Base',
			'formato_fecha'  => 'd/m/Y',
			'miles'          => '.',
			'email'          => 'Base@base.com',
			'email_name'     => 'Base',
			'nombre_empresa' => 'Gobernacion'
    	];

    	foreach ($configuraciones as $propiedad => $valor) {
	        Configuracion::create([
				'propiedad' => $propiedad,
				'valor' => $valor
			]);
    	}
    }
}
