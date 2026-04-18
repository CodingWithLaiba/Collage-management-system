<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
     protected $fillable = [
        'name', 'email', 'phone', 'qualification', 'specialization',
        'experience_years', 'joining_date', 'gender', 'address'
    ];

    // One-to-Many: A teacher has many courses
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    // Accessor: Get teacher's full info
    public function getFullInfoAttribute()
    {
        return $this->name . ' (' . $this->qualification . ')';
    }
    
}
