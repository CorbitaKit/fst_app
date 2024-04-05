<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    public function doGet(): Collection
    {
        return Company::get();
    }

    public function doStore(array $company): void
    {
        $company = Company::create($company);
        Setting::create([
            'company_id' => $company->id,
            'file_storage' => 5120
        ]);
    }

    public function doGetCompany($companyId): Company
    {
        return Company::where('id', $companyId)->first();
    }

    public function doUpdate(array $companyData, int $companyId): void
    {
        $company = Company::findOrFail($companyId);
        $company->update($companyData);
    }

    public function doDestroy($companyId): void
    {
        $company = Company::findOrFail($companyId);
        $company->delete();
    }
}
