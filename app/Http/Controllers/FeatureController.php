<?php

namespace App\Http\Controllers;

use App\Services\FeatureService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeatureController extends Controller
{
    protected $featureService;

    public function __construct(FeatureService $featureService)
    {
        $this->featureService = $featureService;
    }

    public function index()
    {
        $features = $this->featureService->doGet();

        return Inertia::render('features/index', [
            'features' => $features
        ]);
    }

    public function create()
    {
        return Inertia::render('features/create');
    }

    public function store(Request $request)
    {
        $this->featureService->doStore($request->all());
    }
}
