<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Incidencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::create('incidencias', function(Blueprint $table){
				$table->increments('id');
				$table->string('titulo');
				$table->text('descripcion');
				$table->integer('app_usuario_id')->unsigned();
				$table->integer('app_perfil_id')->unsigned();
				$table->integer('estatus_id')->unsigned();
				$table->string('correo');
				$table->timestamps();
				$table->softDeletes();
                
				$table->foreign('app_perfil_id')->references('id')->on('app_perfil')->onDelete('cascade')->onUpdate('cascade');
				$table->foreign('app_usuario_id')->references('id')->on('app_usuario')->onDelete('cascade')->onUpdate('cascade');
				$table->foreign('estatus_id')->references('id')->on('estatus')->onDelete('cascade')->onUpdate('cascade');
			});
	}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
			Schema::dropIfExists('incidencias');

    }
}
