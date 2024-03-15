<?php

namespace App\Services;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Collection;

class ScheduleService
{
    public function doStore(array $schedule): void
    {
        $sched = Schedule::where('employee_id', $schedule['employee_id'])->first();
        $color = $this->generateRandomColor();
        if ($sched) {
            $color = $sched->color;
        }
        $schedule['color'] = $color;
        Schedule::create($schedule);
    }

    public function doGetEmployeeSchedule(int $employeeId): Collection
    {
        return Schedule::where('employee_id', $employeeId)->get();
    }

    public function doUpdate(array $updatedSchedule, int $scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->update($updatedSchedule);
    }

    private  function generateRandomColor()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
