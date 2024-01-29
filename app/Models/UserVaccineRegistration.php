<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVaccineRegistration extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'nid',
        'phone_number',
        'vaccine_centre_id',
        'scheduled_date'
    ];
    public function vaccineCentre(){
        return $this->belongsTo(VaccineCentre::class);
    }
}
