<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Goal;
use App\Models\Plan;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = Plan::all();

        $plans->each(function ($plan) {
            for ($i = 1; $i <= 5; $i++) {
                Goal::create([
                    'plan_id' => $plan->id,
                    'name' => 'Goal ' . $i,
                    'completion_date' => now()->addDays(15),
                    'date_completed' => null,
                    'status' => 'Active'
                ]);
            }
        });
    }
}
