<?php

namespace App\Models;

use App\Observers\SubGoalObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubGoal extends Model
{
    use HasFactory;

    protected $fillable = ['goal_id', 'name', 'completion_date', 'date_completed', 'status'];
}
