<?php

namespace Database\Factories;

use App\Models\ModalidadCurso;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModalidadCursoFactory extends Factory
{
    // protected $model = ModalidadCurso::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nombre" => $this->faker->randonElement($array = array ("Presencial", "Semi-presencial", "Virtual")),
            "estado" => $this->faker->randomElement($array = array ("AC", "IN")),
            "UsuarioCreacion" => 1
        ];
    }
}
