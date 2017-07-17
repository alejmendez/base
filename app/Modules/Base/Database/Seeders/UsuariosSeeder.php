<?php 

namespace App\Modules\Base\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

use App\Modules\Base\Models\Usuario;
use App\Modules\Base\Models\Personas;
use App\Modules\Base\Models\PersonasDetalles;
use App\Modules\Base\Models\PersonasCorreo;
use App\Modules\Base\Models\PersonasTelefono;
use App\Modules\Base\Models\PersonasDireccion;

class UsuariosSeeder extends Seeder
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
            $persona = Personas::create([
                'tipo_persona_id' => 1,
                'dni'             => 1,
                'nombres'         => 'Administrador'
            ]);

            PersonasDetalles::create([
                'personas_id'      => $persona->id,
                'sexo'             => 'm',
                'profesion_id'     => 1,
                'fecha_nacimiento' => '1987-08-25'
            ]);

            PersonasCorreo::create([
                'personas_id' => $persona->id,
                'principal'   => 1,
                'correo'      => 'admin@dominio.com'
            ]);

            PersonasTelefono::create([
                'personas_id'      => $persona->id,
                'tipo_telefono_id' => 1,
                'numero'           => '0414-850-8123',
                'principal'        => 1
            ]);
            
            PersonasDireccion::create([
                'personas_id'   => $persona->id,
                'estados_id'    => 6,
                'ciudades_id'   => 77,
                'municipios_id' => 70,
                'parroquias_id' => 235,
                'direccion'     => ''
            ]);

            Usuario::create([
                'personas_id' => $persona->id,
                'usuario'     => 'admin',
                'password'    => 'admin',
                'perfil_id'   => 1,
                'super'       => 's'
    		]);
        }catch(Exception $e){
            DB::rollback();
            echo "Error ";
        }
        DB::commit();
    }
}
