<?php

namespace App\Services;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ScheduleService
{
    public function doStore(array $schedule): void
    {
        $sched = Schedule::where('employee_id', $schedule['employee_id'])->first();
        $color = $this->generateRandomColor();
        if ($sched) {
            $color = $sched->color;
        }
        $schedule['start'] = Carbon::parse($schedule['start'])->format('Y-m-d');
        $schedule['end'] = Carbon::parse($schedule['end'])->subDays(1)->format('Y-m-d');
        $schedule['color'] = $color;

        Schedule::create($schedule);
    }

    public function doGetEmployeeSchedule(string $employeeIds): Collection
    {
        $ids = json_decode($employeeIds, true);

        if (in_array(Auth::user()->employee->id, $ids)) {
            $calendar = Schedule::whereIn('employee_id', $ids)->get();
        } else {
            $calendar = Schedule::whereIn('employee_id', $ids)->where('is_public', 1)->get();
        }


        $calendar = $this->setEventStart($calendar);

        return $calendar;
    }

    public function doGetAllEmployeeSchedules(): Collection
    {
        $employeeId = Auth::user()->employee->id;
        $schedules = Schedule::whereHas('employee', function ($query) use ($employeeId) {
            $query->where('company_id', $employeeId);
        })->where('type', 'Schedule')->get();

        $schedules = $this->setEventStart($schedules);
        return $schedules;
    }

    public function doGetSchedule(int $scheduleId): Schedule
    {
        return Schedule::with('employee')->where('id', $scheduleId)->first();
    }

    public function doUpdate(array $updatedSchedule, int $scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->update($updatedSchedule);
    }

    public function doGet(): Collection
    {
        return Schedule::where('is_public', 1)->get();
    }

    public function doDestroy(int $scheduleId): void
    {
        Schedule::findOrFail($scheduleId)->delete();
    }

    public function doMarkAsPrivate(int $scheduleId): void
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $schedule->update(['is_public' => 0]);
    }

    private  function generateRandomColor()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    private function setEventStart(object $calendar): Collection
    {
        $calendar = $calendar->map(function ($post) {
            $post['start'] =  $post->start . ' ' . $post->start_time;
            $post['end'] =  $post->end . ' ' . $post->end_time;
            return $post;
        });

        return $calendar;
    }
}
