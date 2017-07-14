<?php 

namespace App\Modules\Base\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

use App\Modules\Base\Models\TipoTelefono;

class TipoTelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try{
            TipoTelefono::create([
                'nombre'         => 'Movil'
            ]);
            TipoTelefono::create([
                'nombre'         => 'Casa'
            ]);
        }catch(Exception $e){
            DB::rollback();
            echo "Error ";
        }
        DB::commit();
    }
}
