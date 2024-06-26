<?php

namespace App\Providers;

use App\Events\JournalProcessed;
use App\Events\MedicineProcessed;
use App\Listeners\SaveJournalProcess;
use App\Listeners\SaveMedicineProcess;
use App\Models\Journal;
use App\Models\Medicine;
use App\Models\SubGoal;
use App\Models\User;
use App\Observers\JournalObserver;
use App\Observers\MedicineObserver;
use App\Observers\SubGoalObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        SubGoal::observe(SubGoalObserver::class);
        Journal::observe(JournalObserver::class);
        Medicine::observe(MedicineObserver::class);
        User::observe(UserObserver::class);
        Event::listen(
            JournalProcessed::class,
            SaveJournalProcess::class
        );
        Event::listen(
            MedicineProcessed::class,
            SaveMedicineProcess::class
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
