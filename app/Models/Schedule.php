<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['start', 'end', 'employee_id', 'title', 'color', 'is_public', 'type', 'start_time', 'end_time'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
