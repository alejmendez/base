<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_usuario', function(Blueprint $table){
            $table->increments('id');
            
            $table->integer('personas_id')->unsigned()->unique();

            $table->string('usuario', 50)->unique();
            $table->string('password', 60);

            $table->integer('perfil_id')->unsigned()->nullable();
            $table->char('super', 1)->default('n');
            $table->char('vendedor', 1)->default('n');
            
            $table->rememberToken();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('personas_id')
                  ->references('id')->on('personas')
                  ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('perfil_id')
                  ->references('id')->on('app_perfil')
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
        Schema::dropIfExists('app_usuario');
    }
}
