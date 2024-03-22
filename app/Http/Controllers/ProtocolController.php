<?php

namespace App\Http\Controllers;

use App\Services\ProtocolService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProtocolController extends Controller
{
    private $protocolService;

    public function __construct(ProtocolService $protocolService)
    {
        $this->protocolService = $protocolService;
    }
    public function index()
    {
        return Inertia::render('protocols/index', [
            'protocols' => $this->protocolService->doGet()
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
}
