<?php

namespace App\Providers;

use App\Interfaces\PlansAndGoalsInterface;
use App\Services\GoalService;
use App\Services\PlanService;
use App\Services\SubGoalService;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class PlansAndGoalsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PlansAndGoalsInterface::class, function ($app) {
            $routeName = $this->app->request->getRequestUri();
            $uri = explode('/', $routeName);
            switch ($uri[1]) {
                case 'plans':
                    return new PlanService();
                case 'goals':
                    return new GoalService();
                case 'sub_goals':
                    return new SubGoalService();
                default:
                    return new PlanService();
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
