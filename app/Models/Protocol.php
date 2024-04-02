<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date', 'organizer_id'];
    public function citizens()
    {
        return $this->belongsToMany(Citizen::class, 'citizen_protocols')->withPivot('date', 'status', 'id');
    }
}
