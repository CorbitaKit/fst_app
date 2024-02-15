<?php

namespace App\Http\Controllers;

use App\Interfaces\PlansAndGoalsInterface;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    private $goalService;

    public function __construct(PlansAndGoalsInterface $plansAndGoalsInterface)
    {
        $this->goalService = $plansAndGoalsInterface;
    }

    public function store(Request $request)
    {
        $this->goalService->doCreate($request->all());
    }
}
