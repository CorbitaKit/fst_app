<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtocolRequest;
use App\Http\Resources\CitizenResource;
use App\Models\CitizenProtocol;
use App\Services\CitizenService;
use App\Services\ProtocolService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProtocolController extends Controller
{
    private $protocolService;
    private $citizenService;

    public function __construct(ProtocolService $protocolService, CitizenService $citizenService)
    {
        $this->protocolService = $protocolService;
        $this->citizenService = $citizenService;
    }
    public function index()
    {
        return Inertia::render('protocols/index', [
            'citizens' => $this->citizenService->doGet()
        ]);
    }

    public function create()
    {
        return Inertia::render('protocols/create');
    }

    public function store(ProtocolRequest $request)
    {
        $this->protocolService->doStore($request->all());
    }

    public function removeCitizenIntoProtocol($citizenProtocolId)
    {
        CitizenProtocol::findOrFail($citizenProtocolId)->delete();
    }

    public function markAsAbsent($citizenProtocolId, $status)
    {
        $citizenProtocol = CitizenProtocol::findOrFail($citizenProtocolId);
        $citizenProtocol->update(['status' => $status]);
    }

    public function filterProtocol(Request $request)
    {
        $protocols = $this->protocolService->doFilterProtocol($request->all());

        return response(json_encode($protocols), 200);
    }

    public function getProtocol()
    {
        $protocols = $this->protocolService->doGet();
        return response(json_encode($protocols), 200);
    }

    public function getCitizenProtocol($citizenId)
    {
        $protocols = $this->protocolService->doGetCitizenProtocols($citizenId);

        return response(json_encode($protocols));
    }
}
