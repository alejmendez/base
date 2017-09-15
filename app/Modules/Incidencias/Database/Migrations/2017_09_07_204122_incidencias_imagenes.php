<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncidenciasImagenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias_imagenes', function(Blueprint $table){
            $table->increments('id');
            $table->integer('incidencias_id')->unsigned();
            $table->string('url');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('incidencias_id')
            ->references('id')->on('incidencias')
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
        Schema::dropIfExists('incidencias_imagenes');
    }
}
