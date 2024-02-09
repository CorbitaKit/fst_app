<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class);
    }
    public function cities()
    {
        return $this->hasMany(\App\Models\City::class);
    }
}
