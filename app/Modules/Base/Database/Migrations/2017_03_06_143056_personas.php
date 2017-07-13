<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Personas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('tipo_persona_id')->unsigned();
            $table->string('dni', 20)->unique();
            $table->string('nombres', 200);
            $table->string('foto')->default('user.png');
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_persona_id')
                  ->references('id')->on('tipo_persona')
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
         Schema::dropIfExists('personas');
    }
}
