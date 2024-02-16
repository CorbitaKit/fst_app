<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'content', 'citizen_id', 'date', 'is_favorite', 'is_lock', 'is_draft', 'created_by'];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
