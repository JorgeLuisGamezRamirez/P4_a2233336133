<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;
    
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'gender',
        'dni',
        'address'
    ];
    
    protected $casts = [
        'birth_date' => 'date'
    ];
    
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
