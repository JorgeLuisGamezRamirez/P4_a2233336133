<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Configurar Faker en español
        $this->faker = \Faker\Factory::create('es_ES');
        
        return [
            'name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName() . ' ' . $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'license_number' => 'COL-' . $this->faker->numberBetween(10000, 99999),
            'specialty_id' => \App\Models\Specialty::factory()
        ];
    }
}
