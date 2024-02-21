<?php

namespace App\Http\Controllers;

use App\Interfaces\PlansAndGoalsInterface;
use App\Services\PlansAndGoalsService;
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

    public function markAsComplete($id)
    {
        $this->goalService->markAsComplete($id);
    }

    public function getSubGoals($id)
    {
        $plansAndGoalsService = new PlansAndGoalsService();
        $subGoals = $plansAndGoalsService->GetSubGoals($id);

        return response(json_encode($subGoals), 200);
    }
}
