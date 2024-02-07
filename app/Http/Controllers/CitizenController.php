<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CitizenRequest;
use Inertia\Inertia;
use App\Services\CitizenService;
use App\Services\RegionService;
use Illuminate\Support\Facades\Redirect;

class CitizenController extends Controller
{

    private $citizenService;

    public function __construct(CitizenService $citizenService)
    {
        $this->citizenService = $citizenService;
    }
    public function index()
    {

        return Inertia::render(
            'citizens/index',
            [
                'citizens' => $this->citizenService->doGet(),
            ]
        );
    }

    public function create(RegionService $regionService)
    {
        $regions = $regionService->doGet();
        return Inertia::render(
            'citizens/create',
            [
                'regions' => $regions
            ]
        );
    }

    public function store(CitizenRequest $request)
    {
        $this->citizenService->doStore($request);
        return Redirect::route('citizens.index');
    }

    public function show($citizen_id)
    {
        return Inertia::render('citizens/show', ['citizen' => $this->citizenService->doGetCitizenInfo($citizen_id)]);
    }
}
