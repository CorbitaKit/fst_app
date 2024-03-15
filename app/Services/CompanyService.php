<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    public function doGet(): Collection
    {
        return Company::get();
    }

    public function doStore(array $company): void
    {
        Company::create($company);
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
