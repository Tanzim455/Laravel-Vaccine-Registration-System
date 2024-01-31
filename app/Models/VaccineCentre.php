<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCentre extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(UserVaccineRegistration::class);
    }

    public function scopeWithUnscheduledUsers($query)
    {
        return $query->with(['users' => function ($query) {
            $query->where('is_scheduled', false)
                ->whereNull('scheduled_date');
        }]);

    }
}
