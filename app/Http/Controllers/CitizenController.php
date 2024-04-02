<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CitizenRequest;
use App\Http\Resources\CitizenResource;
use Inertia\Inertia;
use App\Services\CitizenService;
use App\Services\RegionService;
use Illuminate\Log\Logger;
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

    public function edit($citizen_id, RegionService $regionService)
    {
        return Inertia::render(
            'citizens/edit',
            [
                'citizen' => new CitizenResource($this->citizenService->doGetCitizenInfo($citizen_id)),
                'regions' => $regionService->doGet(),
            ]
        );
    }

    public function update(Request $request, $citizen_id)
    {
        $this->citizenService->doUpdate($citizen_id, $request);
        return Redirect::route('citizens.index');
    }

    public function destroy($citizen_id)
    {
        $this->citizenService->doDelete($citizen_id);
    }

    public function getCitizens($startDate, $endDate)
    {
        $citizens = $this->citizenService->doGetCitizens($startDate, $endDate);
        return response(json_encode(CitizenResource::collection($citizens)), 200);
    }
}
