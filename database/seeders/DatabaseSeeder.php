<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Specialty;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario de prueba
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 1. Crear 6 especialidades reales
        $specialties = [
            [
                'name' => 'Cardiología',
                'description' => 'Especialidad médica que se encarga del estudio, diagnóstico y tratamiento de las enfermedades del corazón y del aparato circulatorio.'
            ],
            [
                'name' => 'Dermatología',
                'description' => 'Especialidad médica que se dedica al estudio de la estructura y función de la piel, así como de las enfermedades que la afectan.'
            ],
            [
                'name' => 'Pediatría',
                'description' => 'Rama de la medicina que se especializa en la salud y las enfermedades de los niños desde el nacimiento hasta la adolescencia.'
            ],
            [
                'name' => 'Ginecología',
                'description' => 'Especialidad médica que trata las enfermedades del sistema reproductor femenino.'
            ],
            [
                'name' => 'Traumatología',
                'description' => 'Rama de la medicina que se dedica al estudio de las lesiones del aparato locomotor.'
            ],
            [
                'name' => 'Neurología',
                'description' => 'Especialidad médica que trata los trastornos del sistema nervioso.'
            ]
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }

        // 2. Crear 25 doctores con nombres reales en español
        $faker = \Faker\Factory::create('es_ES');
        $specialtyIds = Specialty::pluck('id');

        for ($i = 0; $i < 25; $i++) {
            Doctor::create([
                'name' => $faker->firstName(),
                'last_name' => $faker->lastName() . ' ' . $faker->lastName(),
                'phone' => $faker->phoneNumber(),
                'license_number' => 'COL-' . $faker->unique()->numberBetween(10000, 99999),
                'specialty_id' => $faker->randomElement($specialtyIds)
            ]);
        }

        // 3. Crear 80 pacientes
        for ($i = 0; $i < 80; $i++) {
            Patient::create([
                'name' => $faker->firstName(),
                'last_name' => $faker->lastName() . ' ' . $faker->lastName(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'birth_date' => $faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['M', 'F']),
                'dni' => $faker->unique()->numerify('########') . $faker->randomLetter(),
                'address' => $faker->address()
            ]);
        }

        // 4. Crear 150 citas distribuidas en los próximos 45 días, solo en horarios hábiles
        $doctorIds = Doctor::pluck('id');
        $patientIds = Patient::pluck('id');
        $appointmentsCreated = 0;
        $maxAttempts = 1000; // Evitar bucle infinito
        $attempts = 0;

        while ($appointmentsCreated < 150 && $attempts < $maxAttempts) {
            $attempts++;
            
            // Generar fecha aleatoria en los próximos 45 días
            $randomDate = Carbon::now()->addDays(rand(1, 45));
            
            // Asegurar que sea día hábil (lunes a sábado, 1=lunes, 7=domingo)
            if ($randomDate->dayOfWeek == 0) { // 0 = domingo
                continue;
            }
            
            // Generar hora entre 8:00 y 19:00, intervalos de 30 minutos
            $hours = range(8, 18); // Última cita a las 18:30
            $minutes = [0, 30];
            
            $hour = $faker->randomElement($hours);
            $minute = $faker->randomElement($minutes);
            
            // Si es las 18, solo permitir hasta las 18:30
            if ($hour == 18 && $minute > 30) {
                continue;
            }
            
            $randomDate->setTime($hour, $minute, 0);
            
            $doctorId = $faker->randomElement($doctorIds);
            
            // Verificar que no exista otra cita para el mismo doctor en el mismo horario
            $existingAppointment = Appointment::where('doctor_id', $doctorId)
                ->where('appointment_date', $randomDate)
                ->first();
                
            if (!$existingAppointment) {
                Appointment::create([
                    'doctor_id' => $doctorId,
                    'patient_id' => $faker->randomElement($patientIds),
                    'appointment_date' => $randomDate,
                    'status' => $faker->randomElement(['scheduled', 'completed', 'cancelled']),
                    'notes' => $faker->optional(0.7)->sentence(10)
                ]);
                $appointmentsCreated++;
            }
        }

        $this->command->info("✅ Base de datos poblada exitosamente:");
        $this->command->info("📋 Especialidades: " . Specialty::count());
        $this->command->info("👩‍⚕️ Doctores: " . Doctor::count());
        $this->command->info("🏥 Pacientes: " . Patient::count());
        $this->command->info("📅 Citas: " . Appointment::count());
    }
}
