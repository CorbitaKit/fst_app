<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Setting;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::create(['name' => 'Test Company', 'status' => 'Active']);

        Setting::create([
            'protocol' => 0,
            'duty_schedule' => 0,
            'company_id' => $company->id,
            'file_storage' => 5120
        ]);
    }
}
