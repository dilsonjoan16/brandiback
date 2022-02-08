<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "area_id" => $this->faker->numberBetween($min = 1, $max = 5),
            "nombre" => $this->faker->randomElement($array = array ('Curso avanzado', 'Curso intermedio', 'Curso basico', 'Curso profesional')),
            "estado" => $this->faker->randomElement($array = array ('ACTIVO', 'INACTIVO')),
            "descripcion" => "Este curso busca prepararte para un mejor futuro",
            "duracion" => $this->faker->randomElement($array = array ('48 horas', '72 horas')),
            "UsuarioCreacion" => 1,
        ];
    }
}
