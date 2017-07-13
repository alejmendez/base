<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Municipios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('estados_id')->unsigned();
            $table->string('nombre',100);
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('estados_id')
                ->references('id')->on('estados')
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
         Schema::dropIfExists('municipio');
    }
}
