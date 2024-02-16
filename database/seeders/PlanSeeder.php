<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\Citizen;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $citizens = Citizen::all();

        $citizens->each(function ($citizen) {
            for ($i = 1; $i <= 5; $i++) {
                Plan::create([
                    'citizen_id' => $citizen->id,
                    'name' => 'Plan ' . $i,
                    'completion_date' => now()->addDays(30),
                    'date_completed' => null,
                    'status' => 'Active'
                ]);
            }
        });
    }
}
