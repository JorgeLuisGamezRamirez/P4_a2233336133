# 🏥 Sistema de Citas Médicas - Laravel

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Database](https://img.shields.io/badge/Database-MySQL%2FSQLite-orange.svg)](https://mysql.com)

## 📋 Descripción del Proyecto

Sistema completo de gestión de citas médicas desarrollado en Laravel con datos realistas generados usando Faker en español. Este proyecto implementa un sistema robusto para la gestión de especialidades médicas, doctores, pacientes y citas con validaciones de horarios hábiles.

## ✨ Características Principales

### 🔹 Datos Generados
- **6 especialidades médicas reales**
- **25 doctores** con nombres y datos realistas en español
- **80 pacientes** con información completa
- **150 citas** distribuidas inteligentemente en próximos 45 días

### 🔹 Validaciones Implementadas
- ✅ Solo días hábiles (Lunes a Sábado)
- ✅ Horarios de 8:00 AM a 7:00 PM
- ✅ Intervalos de 30 minutos por cita
- ✅ Prevención de duplicados doctor-horario
- ✅ Nombres realistas en español (Faker es_ES)

### 🔹 Arquitectura
- **Modelos Eloquent** con relaciones bien definidas
- **Factories realistas** con datos coherentes
- **Seeders inteligentes** con lógica de validación
- **Migraciones completas** con constraints
- **Comando personalizado** para verificación

## 🚀 Instalación y Configuración

### Prerrequisitos
- PHP 8.2 o superior
- Composer
- MySQL o SQLite

### Pasos de Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/JorgeLuisGamezRamirez/P4_a2233336133.git
cd P4_a2233336133

# 2. Instalar dependencias
composer install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate

# 4. Configurar base de datos en .env
DB_CONNECTION=sqlite
# O configurar MySQL según tus preferencias

# 5. Ejecutar migraciones y seeders
php artisan migrate:fresh --seed

# 6. Verificar instalación
php artisan show:results
```

## 📊 Verificación de Datos

### Comandos de Tinker Requeridos

```php
// Contar total de citas
Appointment::count()
// Resultado esperado: 150

// Mostrar doctores con especialidades
Doctor::with('specialty')->take(5)->get()
// Muestra los primeros 5 doctores con sus especialidades
```

### Comando Personalizado
```bash
php artisan show:results
```

## 🏗️ Estructura del Proyecto

### Modelos y Relaciones
- `Specialty` → hasMany → `Doctor`
- `Doctor` → belongsTo → `Specialty` & hasMany → `Appointment`
- `Patient` → hasMany → `Appointment`
- `Appointment` → belongsTo → `Doctor` & `Patient`

### Archivos Principales
```
database/
├── factories/
│   ├── SpecialtyFactory.php     # Especialidades reales
│   ├── DoctorFactory.php        # Doctores con Faker es_ES
│   ├── PatientFactory.php       # Pacientes realistas
│   └── AppointmentFactory.php   # Citas con validación horaria
├── migrations/
│   ├── create_specialties_table.php
│   ├── create_doctors_table.php
│   ├── create_patients_table.php
│   └── create_appointments_table.php
└── seeders/
    └── DatabaseSeeder.php       # ⭐ Archivo principal
```

## 📈 Datos Generados

### Especialidades Médicas
1. Cardiología
2. Dermatología
3. Pediatría
4. Ginecología
5. Traumatología
6. Neurología

### Estadísticas
- 📋 **Especialidades**: 6 reales
- 👩‍⚕️ **Doctores**: 25 con nombres españoles
- 🏥 **Pacientes**: 80 con datos completos
- 📅 **Citas**: 150 en horarios hábiles

## 🔍 Funcionalidades Especiales

### Validación de Horarios Hábiles
- **Días permitidos**: Lunes a Sábado (No domingos)
- **Horario**: 8:00 AM - 7:00 PM (última cita 6:30 PM)
- **Intervalos**: Cada 30 minutos
- **Validación**: No duplicados por doctor-horario

### Datos Realistas en Español
- Nombres y apellidos españoles auténticos
- Números de teléfono con formato español
- Direcciones realistas
- DNIs con formato correcto
- Números de colegiatura únicos (COL-XXXXX)

## 🧪 Testing y Verificación

```bash
# Verificar conteos
php artisan tinker --execute="echo App\Models\Appointment::count();"

# Ver resumen completo
php artisan show:results

# Verificar datos específicos
php artisan tinker
>>> Specialty::all()->pluck('name')
>>> Doctor::with('specialty')->first()
>>> Appointment::whereDate('appointment_date', today())->count()
```

## 📁 Archivos de Entrega

- ✅ `database/seeders/DatabaseSeeder.php` - **Archivo principal**
- ✅ `capturas_tinker.txt` - Resultados de verificación
- ✅ `ENTREGABLES_MAESTRO.md` - Resumen ejecutivo
- ✅ `PROYECTO_CITAS_MEDICAS.md` - Documentación técnica

## 👨‍💻 Autor

**Jorge Luis Gamez Ramirez**
- GitHub: [@JorgeLuisGamezRamirez](https://github.com/JorgeLuisGamezRamirez)
- Proyecto: P4_a2233336133

## 📝 Licencia

Este proyecto es para fines académicos.

---

## 🎯 Cumplimiento de Requisitos

✅ **6 especialidades reales** - Implementado  
✅ **25 doctores con nombres reales** - Implementado con Faker es_ES  
✅ **80 pacientes** - Implementado  
✅ **150 citas en próximos 45 días** - Implementado  
✅ **Solo horarios hábiles (L-S 8:00-19:00)** - Implementado  
✅ **Citas cada 30 minutos** - Implementado  
✅ **DatabaseSeeder completo** - Implementado  
✅ **Capturas de tinker** - Proporcionadas  

**🎉 ¡Proyecto 100% Completo y Funcional!**
