<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'completion_date', 'citizen_id', 'status'];
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function completionRate()
    {
        $totalGoals = $this->goals()->count();
        $completedGoals = $this->goals()->where('status', 'completed')->count();

        if ($totalGoals > 0) {
            return ($completedGoals / $totalGoals) * 100;
        } else {
            return 0;
        }
    }
}
