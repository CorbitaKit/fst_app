<?php

namespace App\Observers;

use App\Models\SubGoal;

class SubGoalObserver
{
    /**
     * Handle the SubGoal "created" event.
     */
    public function created(SubGoal $subGoal): void
    {
        //
    }

    /**
     * Handle the SubGoal "updated" event.
     */
    public function updated(SubGoal $subGoal): void
    {
    }

    /**
     * Handle the SubGoal "deleted" event.
     */
    public function deleted(SubGoal $subGoal): void
    {
        //
    }

    /**
     * Handle the SubGoal "restored" event.
     */
    public function restored(SubGoal $subGoal): void
    {
    }

    /**
     * Handle the SubGoal "force deleted" event.
     */
    public function forceDeleted(SubGoal $subGoal): void
    {
        //
    }
}
