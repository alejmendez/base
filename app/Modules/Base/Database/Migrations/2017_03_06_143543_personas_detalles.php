<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonasDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas_detalles', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('personas_id')->unsigned()->unique();
            $table->integer('profesion_id')->unsigned()->nullable();
            $table->string('sexo', 1);
            $table->date('fecha_nacimiento');
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('personas_id')
                  ->references('id')->on('personas')
                  ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('profesion_id')
                  ->references('id')->on('profesion')
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
       Schema::dropIfExists('personas_detalles');
    }
}
