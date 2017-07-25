<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensaje', function(Blueprint $table){
            $table->increments('id');
            $table->string('mensaje', 200);  

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tipo_notificacion', function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre', 200);//mjs nuevo
            $table->string('ruta');// "/msj"
            $table->timestamps();
            $table->softDeletes();
        });
        // "/msj/3"
        Schema::create('notificaciones', function(Blueprint $table){
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('enviado_id')->unsigned();  
            $table->integer('mensaje_id')->unsigned();
            $table->integer('operacion_id')->unsigned()->nullable();
            $table->boolean('visto')->default(0);
            $table->integer('tipo_notificacion_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('mensaje_id')
            ->references('id')->on('mensaje')
            ->onDelete('cascade')->onUpdate('cascade');  

            $table->foreign('tipo_notificacion_id')
            ->references('id')->on('tipo_notificacion')
            ->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('usuario_id')
            ->references('id')->on('app_usuario')
            ->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('enviado_id')
            ->references('id')->on('app_usuario')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /*
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificaciones');
        Schema::dropIfExists('tipo_notificacion');
        Schema::dropIfExists('mensaje');
    }
}
