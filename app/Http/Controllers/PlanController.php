<?php

namespace App\Http\Controllers;

use App\Interfaces\PlansAndGoalsInterface;
use App\Services\PlansAndGoalsService;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $plansAndGoalsService;
    private $planService;
    public function __construct(PlansAndGoalsService $plansAndGoalsService, PlansAndGoalsInterface $plansAndGoalsInterface)
    {
        $this->plansAndGoalsService = $plansAndGoalsService;
        $this->planService = $plansAndGoalsInterface;
    }

    public function store(Request $request)
    {
        $this->planService->doCreate($request->all());
    }
    public function getCitizenPlansAndGoals($citizen_id)
    {
        $plans = $this->plansAndGoalsService->doGetCitizenPlan($citizen_id);

        return response(json_encode($plans), 200);
    }

    public function getGoalsOfPlan($plan_id)
    {
        $goals = $this->plansAndGoalsService->doGetGoalsOfPlan($plan_id);
        return response(json_encode($goals), 200);
    }
}
