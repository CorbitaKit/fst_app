<?php

namespace App\Listeners;

use App\Events\JournalProcessed;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveJournalProcess
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(JournalProcessed $event): void
    {
        Log::create([
            'user_id' => $event->journal->created_by,
            'action' => $event->action['action'],
            'record_id' => $event->journal->id,
            'record' => $event->record,
            'status' => $event->action['status'],
            'color' => $event->action['color'],
            'icon' => $event->action['icon']
        ]);
    }
}
