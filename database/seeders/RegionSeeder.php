<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            'Hovedstaden',
            'Midtjylland',
            'Nordjylland',
            'Sjælland',
            'Syddanmark',
        ];

        foreach ($regions as $region) {
            \App\Models\Region::create(['region' => $region]);
        }
    }
}
