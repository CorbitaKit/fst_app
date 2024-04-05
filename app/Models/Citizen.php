<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'first_name', 'last_name', 'birth_day', 'note', 'social_security_number', 'phone', 'company_id'];
    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function address()
    {
        return $this->belongsTo(CitizenAddress::class, 'id');
    }

    public function journals()
    {
        return $this->hasmany(Journal::class);
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function protocols()
    {
        return $this->belongsToMany(Protocol::class, 'citizen_protocols');
    }
}
