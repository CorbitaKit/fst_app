<?php

namespace App\Http\Controllers;

use App\Services\AppService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppController extends Controller
{
    protected $appService;

    public function __construct(AppService $appService)
    {
        $this->appService = $appService;
    }
    public function index()
    {
        return Inertia::render(
            'apps/index',
            [
                'apps' => $this->appService->doGet()
            ]
        );
    }
}
