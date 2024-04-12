<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'company_id'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_procedures')
            ->withTimestamps();
    }
}
