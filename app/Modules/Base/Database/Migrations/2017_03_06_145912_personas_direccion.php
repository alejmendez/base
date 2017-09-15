<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonasDireccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('personas_direccion', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('personas_id')->unsigned()->unique();

            $table->integer('estados_id')->unsigned();
            
            $table->integer('ciudades_id')->unsigned()->nullable();
            $table->integer('municipios_id')->unsigned()->nullable();
            $table->integer('parroquias_id')->unsigned()->nullable();
            $table->integer('sectores_id')->unsigned()->nullable();
            $table->string('direccion', 200);
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('personas_id')
                  ->references('id')->on('personas')
                  ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('estados_id')
                ->references('id')->on('estados')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('municipios_id')
                ->references('id')->on('municipios')
                ->onDelete('cascade')->onUpdate('cascade'); 

            $table->foreign('parroquias_id')
                ->references('id')->on('parroquias')
                ->onDelete('cascade')->onUpdate('cascade');
                
            $table->foreign('ciudades_id')
                ->references('id')->on('ciudades')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('sectores_id')
                ->references('id')->on('sectores')
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
        Schema::dropIfExists('personas_direccion');
    }
}
