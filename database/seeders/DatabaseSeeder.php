<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
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
        $admin  = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@fst.com',
            'password' => Hash::make('fstadmin'),
            'role_id' => 2,
            'is_password_changed' => 1
        ]);
        $admin->permissions()->attach([1, 2, 3, 4]);
        $user = \App\Models\User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@fst.com',
            'password' => Hash::make('fstadmin'),
            'role_id' => 3,
            'is_password_changed' => 1
        ]);
        //Save admin in employee table
        Employee::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'phone' => '4501234567',
            'birth_day' => '1991-01-01',
            'address' => 'test address',
            'email' => $admin->email,
            'company_id' => 1,
            'user_id' => $admin->id
        ]);

        //Save regular user in employee Table
        Employee::create([
            'first_name' => 'User',
            'last_name' => 'User',
            'phone' => '4501454567',
            'birth_day' => '1991-02-02',
            'address' => 'test address',
            'email' => $user->email,
            'company_id' => 1,
            'user_id' => $user->id
        ]);
        $this->call([
            RegionSeeder::class,
            MunicipalitySeeder::class,
            CitySeeder::class,
            PlanSeeder::class,
            GoalSeeder::class,
            SubGoalSeeder::class,
            RolesTableSeeder::class,
            PermissionTableSeeder::class,
            AppTableSeeder::class,
            CompanyTableSeeder::class,
        ]);
    }
}
