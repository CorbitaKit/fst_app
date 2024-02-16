<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubGoal;
use App\Models\Goal;

class SubGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $goals = Goal::all();

        $goals->each(function ($goal) {
            for ($i = 1; $i <= 5; $i++) {
                SubGoal::create([
                    'goal_id' => $goal->id,
                    'name' => 'Sub-Goal ' . $i,
                    'completion_date' => now()->addDays(5),
                    'date_completed' => null,
                    'status' => 'Active'
                ]);
            }
        });
    }
}
