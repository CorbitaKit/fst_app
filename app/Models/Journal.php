<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'citizen_id', 'date', 'is_favorite', 'is_lock', 'is_draft'];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }
}
