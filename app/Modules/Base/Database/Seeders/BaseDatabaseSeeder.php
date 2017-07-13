<?php

namespace App\Modules\Base\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BaseDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PerfilesSeeder::class);
        $this->call(UsuariosSeeder::class);

        $this->call(EstadosSeeder::class);
        $this->call(CiudadesSeeder::class);
        $this->call(MunicipiosSeeder::class);
        $this->call(ParroquiasSeeder::class);
    }
}
