<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonasTelefonos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas_telefono', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('personas_id')->unsigned();
            $table->integer('tipo_telefono_id')->unsigned(); 
            $table->boolean('principal')->comment('Correo principal  0 = no , 1= si'); 
            $table->string('numero', 20)->unique();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('personas_id')
                  ->references('id')->on('personas')
                  ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('tipo_telefono_id')
                  ->references('id')->on('tipo_telefono')
                  ->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('personas_telefono');
    }
}
