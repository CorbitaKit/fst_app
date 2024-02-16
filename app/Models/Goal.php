<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = ['plan_id', 'name', 'completion_date', 'date_completed', 'status'];
    public function subGoals()
    {
        return $this->hasMany(SubGoal::class);
    }
}
