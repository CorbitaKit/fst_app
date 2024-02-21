<?php

namespace App\Services;

use App\Interfaces\PlansAndGoalsInterface;
use App\Models\Goal;
use Illuminate\Support\Facades\DB;

class GoalService implements PlansAndGoalsInterface
{
    public function markAsComplete(int $id): void
    {
        $goal = Goal::findOrFail($id);
        $goal->update(['status' => 'complete']);
        $plansAndGoalsService = new PlansAndGoalsService();
        $plansAndGoalsService->checkIfAllGoalsAreCompleted($goal);
    }
    public function doCreate(array $object): void
    {
        DB::beginTransaction();
        try {
            $goal = Goal::create($object);
            $subGoalService = new SubGoalService();

            foreach ($object['sub_goals'] as $subGoal) {
                $subGoal['goal_id'] = $goal->id;
                $subGoalService->doCreate($subGoal);
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function doUpdate(array $data, int $id): void
    {
        $sub_goal = Goal::findOrFail($id);
        $sub_goal->update($data);
    }

    public function doDelete(int $id): void
    {
        Goal::findOrFail($id)->delete();
    }
}
