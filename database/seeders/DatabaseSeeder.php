<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AreaCurso;
use App\Models\Curso;
use App\Models\ModalidadCurso;
use App\Models\TipoCurso;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(1)->create();
        ModalidadCurso::factory(3)->create();
        // TipoCurso::factory(5)->create();
        // AreaCurso::factory(5)->create();
        // Curso::factory(100)->create();
    }
}
