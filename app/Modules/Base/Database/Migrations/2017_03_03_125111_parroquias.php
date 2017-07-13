<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parroquias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parroquias', function(Blueprint $table){
            $table->increments('id');
            
            $table->string('nombre', 100);
            $table->integer('municipios_id')->unsigned();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('municipios_id')
                ->references('id')->on('municipios')
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
         Schema::dropIfExists('parroquia');
    }
}
