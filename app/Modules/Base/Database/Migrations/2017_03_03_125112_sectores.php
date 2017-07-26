<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sectores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectores', function(Blueprint $table){
            $table->increments('id');
            
            $table->string('nombre', 100);
            $table->string('slug', 100);
            $table->integer('parroquias_id')->unsigned();

            $table->unique(['slug', 'parroquias_id'], 'sector_index_unique');
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parroquias_id')
                ->references('id')->on('parroquias')
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
         Schema::dropIfExists('sector');
    }
}
