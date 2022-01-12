<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('area_id')
                  ->unsigned()
                  ->nullable()
                  ->constrained('area_cursos')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

            $table->string('nombre');
            $table->string('estado');
            $table->integer('duracion');

            $table->bigInteger('UsuarioCreacion')
                  ->unsigned()
                  ->nullable()
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

            $table->bigInteger('UsuarioModificacion')
                  ->unsigned()
                  ->nullable()
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

            $table->timestamps();

            // $table->foreign('area_id')->references('id')->on('area_cursos')->onDelete('set null')->onUpdate('cascade');
            // $table->foreign('UsuarioCreacion')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            // $table->foreign('UsuarioModificacion')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
