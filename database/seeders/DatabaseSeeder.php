<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AreaCurso;
use App\Models\Curso;
use App\Models\ModalidadCurso;
use App\Models\TipoCurso;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name" => "SuperAdmin",
            "email" => "admin@admin.com",
            "password" => Hash::make('Usuar10#'),
            "rol" => "Admin",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
          ]);
        DB::table('modalidad_cursos')->insert([
            "nombre" => "Presencial",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('modalidad_cursos')->insert([
            "nombre" => "Mixta",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('modalidad_cursos')->insert([
            "nombre" => "Virtual",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('tipo_cursos')->insert([
            "modalidad_id" => 1,
            "nombre" => "Cursos a Empresas",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('tipo_cursos')->insert([
            "modalidad_id" => 1,
            "nombre" => "Cursos a Empresarios",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('tipo_cursos')->insert([
            "modalidad_id" => 2,
            "nombre" => "Cursos Especiales",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('tipo_cursos')->insert([
            "modalidad_id" => 2,
            "nombre" => "Cursos Tecnicos",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('tipo_cursos')->insert([
            "modalidad_id" => 3,
            "nombre" => "Cursos Gerenciales",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('tipo_cursos')->insert([
            "modalidad_id" => 3,
            "nombre" => "Cursos a Autonomos",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('area_cursos')->insert([
            "tipo_id" => 1,
            "nombre" => "Informatica",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('area_cursos')->insert([
            "tipo_id" => 2,
            "nombre" => "Plomeria",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('area_cursos')->insert([
            "tipo_id" => 3,
            "nombre" => "Psicologia",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('area_cursos')->insert([
            "tipo_id" => 4,
            "nombre" => "Desarrollo Humano",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('area_cursos')->insert([
            "tipo_id" => 5,
            "nombre" => "Ofimatica",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('area_cursos')->insert([
            "tipo_id" => 6,
            "nombre" => "Electricidad",
            "estado" => "ACTIVO",
            "UsuarioCreacion" => 1,
        ]);
        DB::table('cursos')->insert([
            "area_id" => 1,
            "nombre" => "Laravel avanzado",
            "estado" => "ACTIVO",
            "descripcion" => "Laravel en su totalidad",
            "duracion" => 310,
            "precio" => 100,
            "UsuarioCreacion" => 1,
        ]);
        DB::table('cursos')->insert([
            "area_id" => 2,
            "nombre" => "Calibracion de presion en tuberias industriales",
            "estado" => "ACTIVO",
            "descripcion" => "Se aprendera a calibrar la presion en BARES, PSI y demas medidas",
            "duracion" => 210,
            "precio" => 120,
            "UsuarioCreacion" => 1,
        ]);
        DB::table('cursos')->insert([
            "area_id" => 3,
            "nombre" => "El Yo, Ello y Super Yo",
            "estado" => "ACTIVO",
            "descripcion" => "Se aprendera sobre la Teoria de Sigmud Freud de la Personalidad multiple",
            "duracion" => 72,
            "precio" => 130,
            "UsuarioCreacion" => 1,
        ]);
        DB::table('cursos')->insert([
            "area_id" => 4,
            "nombre" => "El Liderazgo como herramienta Humana",
            "estado" => "ACTIVO",
            "descripcion" => "Se aprendera sobre el Liderazgo como herramienta formadora de Hombres",
            "duracion" => 172,
            "precio" => 140,
            "UsuarioCreacion" => 1,
        ]);
        DB::table('cursos')->insert([
            "area_id" => 5,
            "nombre" => "Excel Avanzado",
            "estado" => "ACTIVO",
            "descripcion" => "Se aprendera sobre Excel a un nivel superior",
            "duracion" => 162,
            "precio" => 150,
            "UsuarioCreacion" => 1,
        ]);
        DB::table('cursos')->insert([
            "area_id" => 6,
            "nombre" => "Circuitos Domesticos",
            "estado" => "ACTIVO",
            "descripcion" => "Se aprendera sobre la construccion de circuitos electricos en los hogares",
            "duracion" => 90,
            "precio" => 160,
            "UsuarioCreacion" => 1,
        ]);
        // User::factory(1)->create();
        // ModalidadCurso::factory(3)->create();
        // TipoCurso::factory(5)->create();
        // AreaCurso::factory(5)->create();
        // Curso::factory(100)->create();
    }
}
