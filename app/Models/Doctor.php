<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory;
    
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'license_number',
        'specialty_id'
    ];
    
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
    
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
