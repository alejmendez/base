<?php

namespace App\Modules\Base\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

use App\Modules\Base\Models\Profesion;

class ProfesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Ing en Informatica'
        ];

        DB::beginTransaction();
        try{
            foreach ($data as $Profesion) {
                Profesion::create([
                    'nombre'      => $Profesion,
                    'slug'        => str_slug($Profesion)
                ]);
            }
        }catch(Exception $e){
            DB::rollback();
            echo "Error ";
        }
        DB::commit();
    }
}
