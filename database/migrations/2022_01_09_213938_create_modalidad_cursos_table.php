<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalidadCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalidad_cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('estado');

            $table->foreignId('UsuarioCreacion')
                  ->unsigned()
                  ->nullable()
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

            $table->foreignId('UsuarioModificacion')
                  ->unsigned()
                  ->nullable()
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

            $table->timestamps();

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
        Schema::dropIfExists('modalidad_cursos');
    }
}
