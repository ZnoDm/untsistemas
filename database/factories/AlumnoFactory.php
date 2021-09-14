<?php

namespace Database\Factories;

use App\Models\Alumno;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlumnoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alumno::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo'=> $this->faker->unique()->numberBetween(1000000000,1199999999),
            'apellido'=> $this->faker->lastName,
            'nombre'=> $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'fecha_nacimiento'=> date_format($this->faker->dateTimeBetween('-2 years','now'),'Y-m-d'),
            'telefono'=> $this->faker->numberBetween(900000000,999999999),
        ];
    }
}
