<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_cursos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('modalidad_id')->unsigned();
            $table->string('nombre');
            $table->string('estado');
            $table->bigInteger('UsuarioCreacion')->unsigned();
            $table->bigInteger('UsuarioModificacion')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('modalidad_id')->references('id')->on('modalidad_cursos')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('tipo_cursos');
    }
}
