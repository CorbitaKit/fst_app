<?php

namespace App\Services;

use App\Interfaces\PlansAndGoalsInterface;
use App\Models\SubGoal;
use Illuminate\Support\Facades\Date;

class SubGoalService implements PlansAndGoalsInterface
{

    public function markAsComplete(int $id): void
    {
        $subGoal = SubGoal::findOrFail($id);
        $subGoal->update(['status' => 'complete', 'date_completed' => Date::now()]);
        $plansAndGoalsService = new PlansAndGoalsService();
        $plansAndGoalsService->checkIfAllSubGoalsAreCompleted($subGoal);
    }
    public function doCreate(array $object): void
    {
        SubGoal::create($object);
    }

    public function doUpdate(array $data, int $id): void
    {
        $subGoal = SubGoal::findOrFail($id);
        $subGoal->update($data);
    }

    public function doDelete(int $id): void
    {
        SubGoal::findOrFail($id)->delete();
    }
}
