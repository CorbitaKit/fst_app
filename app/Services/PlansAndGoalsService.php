<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Goal;
use Illuminate\Database\Eloquent\Collection;

class PlansAndGoalsService
{
    public function doGetCitizenPlan($citizenID): Collection
    {
        return Plan::with('goals.subGoals')->where('citizen_id', $citizenID)->get();
    }

    public function doGetGoalsOfPlan($plan_id): Collection
    {
        return Goal::where('plan_id', $plan_id)->where('status', 'Active')->get();
    }

    public function checkIfAllSubGoalsAreCompleted(object $subGoal): void
    {
        $completedCtr = 0;
        $goal = Goal::with('subGoals')->where('id', $subGoal->goal_id)->first();
        foreach ($goal->subGoals as $sub) {

            if ($sub->status == 'complete') {
                $completedCtr++;
            }
        }

        if ($goal->subGoals->count() === $completedCtr) {
            $goal->update(['status' => 'complete']);
        }
    }
}
