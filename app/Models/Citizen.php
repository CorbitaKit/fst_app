<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

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
}
