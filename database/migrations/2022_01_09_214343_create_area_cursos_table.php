<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_cursos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipo_id')->unsigned();
            $table->string('nombre');
            $table->string('estado');
            $table->bigInteger('UsuarioCreacion')->unsigned();
            $table->bigInteger('UsuarioModificacion')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipo_cursos')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('UsuarioCreacion')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('UsuarioModificacion')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_cursos');
    }
}
