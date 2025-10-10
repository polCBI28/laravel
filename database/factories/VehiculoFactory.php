<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marca' => $this->faker-> word(1,true),
            'modelo' => $this->faker-> word(1,true),
            'anio' => $this->faker-> numberBetween(2000 , 2015),
            'color' => $this->faker-> hexColor(),

            

        ];
    }
}
