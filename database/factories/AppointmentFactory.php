<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generar fecha en los próximos 45 días
        $startDate = now();
        $endDate = now()->addDays(45);
        
        // Generar fecha aleatoria en el rango
        $randomDate = $this->faker->dateTimeBetween($startDate, $endDate);
        
        // Asegurar que sea día hábil (lunes a sábado)
        while ($randomDate->format('N') == 7) { // 7 = domingo
            $randomDate = $this->faker->dateTimeBetween($startDate, $endDate);
        }
        
        // Generar hora entre 8:00 y 19:00, con intervalos de 30 minutos
        $hours = range(8, 18); // 8:00 a 18:30 (última cita a las 18:30)
        $minutes = [0, 30];
        
        $hour = $this->faker->randomElement($hours);
        $minute = $this->faker->randomElement($minutes);
        
        // Si es la hora 18, solo permitir minuto 30 o menos
        if ($hour == 18 && $minute == 30) {
            $minute = 30;
        }
        
        $randomDate->setTime($hour, $minute);
        
        return [
            'doctor_id' => \App\Models\Doctor::factory(),
            'patient_id' => \App\Models\Patient::factory(),
            'appointment_date' => $randomDate,
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
            'notes' => $this->faker->optional(0.7)->sentence(10)
        ];
    }
}
