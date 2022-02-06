<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TipoCursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "modalidad_id" => $this->faker->numberBetween($min = 1, $max = 3),
            "nombre" => $this->faker->randomElement($array = array ('Cursos permanentes', 'Cursos especiales', 'Cursos de campo', 'Cursos a empresas', 'Cursos a institutos')),
            "estado" => $this->faker->randomElement($array = array ('AC', 'IN')),
            "UsuarioCreacion" => 1
        ];
    }
}
