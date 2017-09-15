<?php

namespace App\Modules\Base\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

use App\Modules\Base\Models\TipoPersona;

class TipoPersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['V', 'Venezolano'],
            ['E', 'Extranjero'],
            ['G', 'Gubernamental'],
            ['J', 'Juridico']
        ];

        DB::beginTransaction();
        try{
            foreach ($data as $tipo_persona) {
                TipoPersona::create([
                    'nombre'      => $tipo_persona[0],
                    'descripcion' => $tipo_persona[1]
                ]);
            }
        }catch(Exception $e){
            DB::rollback();
            echo "Error ";
        }
        DB::commit();
    }
}
