# Sistema de Citas Médicas - Laravel

## Descripción del Proyecto
Sistema de gestión de citas médicas desarrollado en Laravel con factories realistas usando Faker en español.

## Estructura de la Base de Datos

### Tablas Creadas
1. **specialties** - Especialidades médicas
2. **doctors** - Información de doctores
3. **patients** - Información de pacientes  
4. **appointments** - Citas médicas

### Modelos y Relaciones
- `Specialty` hasMany `Doctor`
- `Doctor` belongsTo `Specialty` and hasMany `Appointment`
- `Patient` hasMany `Appointment`
- `Appointment` belongsTo `Doctor` and `Patient`

## Datos Generados

### ✅ Especialidades (6 reales)
- Cardiología
- Dermatología
- Pediatría
- Ginecología
- Traumatología
- Neurología

### ✅ Doctores (25 con nombres reales en español)
Cada doctor tiene:
- Nombre y apellidos en español (usando Faker es_ES)
- Número de teléfono aleatorio
- Número de colegiatura único (COL-XXXXX)
- Especialidad asignada

### ✅ Pacientes (80)
Cada paciente tiene:
- Nombre y apellidos en español
- Email único
- Teléfono
- Fecha de nacimiento (18-80 años)
- Género (M/F)
- DNI único
- Dirección

### ✅ Citas (150 en próximos 45 días)
**Restricciones de horarios hábiles implementadas:**
- **Días:** Lunes a Sábado (NO domingos)
- **Horarios:** 8:00 - 19:00
- **Duración:** Cada cita dura 30 minutos
- **Intervalos:** 8:00, 8:30, 9:00, 9:30... hasta 18:30

## Comandos de Verificación

### Comandos requeridos por el maestro:

```php
// En Tinker:
Appointment::count()
// Resultado: 150

Doctor::with('specialty')->take(5)->get()
// Muestra los primeros 5 doctores con sus especialidades
```

### Comando personalizado para verificación completa:
```bash
php artisan show:results
```

## Instalación y Configuración

1. **Clonar y configurar:**
```bash
composer install
cp .env.example .env
php artisan key:generate
```

2. **Configurar base de datos en .env**

3. **Ejecutar migraciones y seeders:**
```bash
php artisan migrate:fresh
php artisan db:seed
```

4. **Verificar resultados:**
```bash
php artisan show:results
```

## Archivos Principales

### Migraciones
- `create_specialties_table.php`
- `create_doctors_table.php` 
- `create_patients_table.php`
- `create_appointments_table.php`

### Modelos
- `app/Models/Specialty.php`
- `app/Models/Doctor.php`
- `app/Models/Patient.php`
- `app/Models/Appointment.php`

### Factories
- `database/factories/SpecialtyFactory.php`
- `database/factories/DoctorFactory.php`
- `database/factories/PatientFactory.php`
- `database/factories/AppointmentFactory.php`

### Seeders
- `database/seeders/DatabaseSeeder.php` - **¡Archivo principal solicitado!**

## Características Especiales

### Faker en Español
Configurado para generar nombres, apellidos, direcciones y teléfonos realistas en español usando `es_ES` locale.

### Validación de Horarios
- No se generan citas en domingo
- Solo horarios de 8:00 a 19:00 
- Intervalos de 30 minutos
- No duplicados doctor-horario

### Datos Realistas
- Especialidades médicas reales
- Números de colegiatura con formato COL-XXXXX
- DNIs con formato realista
- Estados de cita: scheduled, completed, cancelled

## Verificación de Cumplimiento

✅ **6 especialidades reales** - Implementado  
✅ **25 doctores con nombres reales** - Implementado con Faker es_ES  
✅ **80 pacientes** - Implementado  
✅ **150 citas en próximos 45 días** - Implementado  
✅ **Solo horarios hábiles (L-S 8:00-19:00)** - Implementado  
✅ **Citas cada 30 minutos** - Implementado  
✅ **DatabaseSeeder completo** - Implementado  
✅ **Comandos de verificación** - Implementado  

## Autor
Desarrollado para cumplir con los requerimientos de la tarea de base de datos con Laravel.