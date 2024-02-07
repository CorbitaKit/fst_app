<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'Super Admin User',
            'email' => 'super.admin@fst.com',
            'password' => Hash::make('fstadmin'),
            'role_id' => 1
        ]);

        $this->call([
            RegionSeeder::class,
            CitySeeder::class,
        ]);
    }
}
