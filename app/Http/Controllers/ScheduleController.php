<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    private $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index()
    {
        return Inertia::render('employee_schedules/index');
    }
    public function store(Request $request)
    {
        $this->scheduleService->doStore($request->all());
    }

    public function getEmployeeSchedule($employeeId)
    {
        $schedules = $this->scheduleService->doGetEmployeeSchedule($employeeId);

        return response(json_encode($schedules), 200);
    }

    public function update(Request $request, $scheduleId)
    {
        $this->scheduleService->doUpdate($request->all(), $scheduleId);
    }

    public function show($scheduleId)
    {
        $schedules = $this->scheduleService->doGetSchedule($scheduleId);
        return response(json_encode($schedules), 200);
    }

    public function destroy($scheduleId)
    {
        $this->scheduleService->doDestroy($scheduleId);
    }

    public function markAsPrivate($scheduleId)
    {
        $this->scheduleService->doMarkAsPrivate($scheduleId);
    }
}
