<?php

namespace App\Services;

use App\Interfaces\PlansAndGoalsInterface;
use App\Models\Plan;
use App\Services\GoalService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlanService implements PlansAndGoalsInterface
{
    public function markAsComplete(int $id): void
    {
        $sub_goal = Plan::findOrFail($id);
        $sub_goal->update(['status' => 'complete']);
    }
    public function doCreate(array $object): void
    {

        DB::beginTransaction();
        try {
            $object['completion_date'] = Carbon::parse($object['completion_date'])->format('Y-m-d');
            $plan = Plan::create($object);
            $goalService = new GoalService();

            foreach ($object['goals'] as $goal) {
                $goal['plan_id'] = $plan->id;
                $goalService->doCreate($goal);
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function doUpdate(array $data, int $id): void
    {
        $sub_goal = Plan::findOrFail($id);
        $sub_goal->update($data);
    }

    public function doDelete(int $id): void
    {
        Plan::findOrFail($id)->delete();
    }
}
