<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function municipality()
    {
        return $this->belongsTo(\App\Models\Municipality::class);
    }
}
