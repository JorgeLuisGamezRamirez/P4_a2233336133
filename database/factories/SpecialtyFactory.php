<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specialty>
 */
class SpecialtyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specialties = [
            'Cardiología' => 'Especialidad médica que se encarga del estudio, diagnóstico y tratamiento de las enfermedades del corazón y del aparato circulatorio.',
            'Dermatología' => 'Especialidad médica que se dedica al estudio de la estructura y función de la piel, así como de las enfermedades que la afectan.',
            'Pediatría' => 'Rama de la medicina que se especializa en la salud y las enfermedades de los niños desde el nacimiento hasta la adolescencia.',
            'Ginecología' => 'Especialidad médica que trata las enfermedades del sistema reproductor femenino.',
            'Traumatología' => 'Rama de la medicina que se dedica al estudio de las lesiones del aparato locomotor.',
            'Neurología' => 'Especialidad médica que trata los trastornos del sistema nervioso.'
        ];
        
        $specialty = $this->faker->randomElement(array_keys($specialties));
        
        return [
            'name' => $specialty,
            'description' => $specialties[$specialty]
        ];
    }
}
