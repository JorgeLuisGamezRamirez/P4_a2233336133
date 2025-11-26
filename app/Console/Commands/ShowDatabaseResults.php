<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowDatabaseResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mostrar resultados de la base de datos para la tarea';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== RESULTADOS DE LA BASE DE DATOS ===');
        $this->newLine();
        
        // 1. Mostrar Appointment::count()
        $this->info('1. Appointment::count()');
        $this->line(\App\Models\Appointment::count());
        $this->newLine();
        
        // 2. Mostrar Doctor::with('specialty')->take(5)->get()
        $this->info("2. Doctor::with('specialty')->take(5)->get()");
        $doctors = \App\Models\Doctor::with('specialty')->take(5)->get();
        
        foreach ($doctors as $doctor) {
            $this->line("Dr. {$doctor->name} {$doctor->last_name} - {$doctor->specialty->name}");
        }
        
        $this->newLine();
        $this->info('=== RESUMEN COMPLETO ===');
        $this->line('📋 Especialidades: ' . \App\Models\Specialty::count());
        $this->line('👩‍⚕️ Doctores: ' . \App\Models\Doctor::count());
        $this->line('🏥 Pacientes: ' . \App\Models\Patient::count());
        $this->line('📅 Citas: ' . \App\Models\Appointment::count());
        
        $this->newLine();
        $this->info('=== ESPECIALIDADES CREADAS ===');
        $specialties = \App\Models\Specialty::all();
        foreach ($specialties as $specialty) {
            $this->line("- {$specialty->name}");
        }
        
        $this->newLine();
        $this->info('=== CITAS POR ESTADO ===');
        $appointments = \App\Models\Appointment::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();
            
        foreach ($appointments as $appointment) {
            $this->line("- {$appointment->status}: {$appointment->count} citas");
        }
        
        $this->newLine();
        $this->info('=== VERIFICACIÓN DE HORARIOS HÁBILES ===');
        $appointments = \App\Models\Appointment::all();
        $days = [];
        $hours = [];
        
        foreach ($appointments as $apt) {
            $date = \Carbon\Carbon::parse($apt->appointment_date);
            $dayName = $date->format('l');
            $hour = $date->format('H:i');
            
            $days[$dayName] = ($days[$dayName] ?? 0) + 1;
            $hours[$hour] = ($hours[$hour] ?? 0) + 1;
        }
        
        $this->line('Distribución por días:');
        foreach ($days as $day => $count) {
            $this->line("  - {$day}: {$count} citas");
        }
        
        $this->newLine();
        $this->line('Horarios más frecuentes:');
        arsort($hours);
        $topHours = array_slice($hours, 0, 5, true);
        foreach ($topHours as $hour => $count) {
            $this->line("  - {$hour}: {$count} citas");
        }
    }
}
