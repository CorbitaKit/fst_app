<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineJournal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'medicine_id', 'citizen_id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function citizen()
    {
        return $this->belongsTo(\App\Models\Citizen::class);
    }

    public function medicine()
    {
        return $this->belongsTo(\App\Models\Medicine::class);
    }
}
