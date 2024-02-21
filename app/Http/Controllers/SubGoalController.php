<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\PlansAndGoalsInterface;

class SubGoalController extends Controller
{

    private $subGoalService;

    public function __construct(PlansAndGoalsInterface $plansAndGoalsInterface)
    {
        $this->subGoalService = $plansAndGoalsInterface;
    }

    public function store(Request $request)
    {
        $this->subGoalService->doCreate($request->all());
    }
    public function markAsComplete($id)
    {
        $this->subGoalService->markAsComplete($id);
    }
}
