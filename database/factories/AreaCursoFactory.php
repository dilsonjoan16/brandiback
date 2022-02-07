<?php

namespace Database\Factories;

use App\Models\AreaCurso;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaCursoFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "tipo_id" => $this->faker->numberBetween($min = 1, $max = 5),
            "nombre" => $this->faker->randomElement($array = array ('Ofimatica', 'Redes', 'Electricidad', 'Informatica', 'Gerencia')),
            "estado" => $this->faker->randomElement($array = array ('AC', 'IN')),
            "UsuarioCreacion" => 1
        ];
    }
}
