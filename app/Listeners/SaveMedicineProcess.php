<?php

namespace App\Listeners;

use App\Events\MedicineProcessed;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveMedicineProcess
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
    public function handle(MedicineProcessed $event): void
    {
        Log::create([
            'user_id' => $event->medicine->user_id,
            'action' => $event->action['action'],
            'record_id' => $event->medicine->id,
            'record' => $event->record,
            'status' => $event->action['status'],
            'color' => $event->action['color'],
            'icon' => $event->action['icon']
        ]);
    }
}
