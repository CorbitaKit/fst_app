<?php

namespace App\Http\Controllers;

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
            'protocols' => $this->protocolService->doGet(),
            'citizens' => $this->citizenService->doGet()
        ]);
    }

    public function create()
    {
        return Inertia::render('protocols/create');
    }

    public function store(Request $request)
    {
        $this->protocolService->doStore($request->all());
    }

    public function removeCitizenIntoProtocol($citizenProtocolId)
    {
        CitizenProtocol::findOrFail($citizenProtocolId)->delete();
    }

    public function markAsAbsent($citizenProtocolId)
    {
        $citizenProtocol = CitizenProtocol::findOrFail($citizenProtocolId);
        $citizenProtocol->update(['status' => 'Absent']);
    }
}
