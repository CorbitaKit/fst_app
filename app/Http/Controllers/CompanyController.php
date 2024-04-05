<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        return Inertia::render(
            'companies/index',
            [
                'companies' => $this->companyService->doGet()
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'companies/create'
        );
    }

    public function store(Request $request)
    {
        $this->companyService->doStore($request->all());
    }

    public function edit($companyId)
    {
        return Inertia::render(
            'companies/edit',
            [
                'company' => $this->companyService->doGetCompany($companyId)
            ]
        );
    }

    public function update(Request $request, $companyId)
    {
        $this->companyService->doUpdate($request->all(), $companyId);
    }

    public function destroy($companyId)
    {
        $this->companyService->doDestroy($companyId);
    }
}
