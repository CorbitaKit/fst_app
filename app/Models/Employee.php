<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'address', 'birth_day', 'company_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function procedures()
    {
        return $this->belongsToMany(Procedure::class, 'employee_procedures')
            ->withTimestamps();
    }
}
