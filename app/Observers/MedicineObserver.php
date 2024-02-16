<?php

namespace App\Observers;

use App\Events\MedicineProcessed;
use App\Models\Medicine;

class MedicineObserver
{
    /**
     * Handle the Medicine "created" event.
     */
    public function created(Medicine $medicine): void
    {
        $action = [
            'action' => 'Issued a medicine because citizen is ' . $medicine->description,
            'color' => '#22c55e',
            'icon' => 'pi pi-plus',
            'status' => 'Create'
        ];
        MedicineProcessed::dispatch($medicine, $action, 'medicine');
    }

    /**
     * Handle the Medicine "updated" event.
     */
    public function updated(Medicine $medicine): void
    {
        $action = [
            'action' => 'updated the medicine record',
            'color' => '#0ea5e9',
            'icon' => 'pi pi-file-edit',
            'status' => 'Update'
        ];
        MedicineProcessed::dispatch($medicine, $action, 'medicine');
    }

    /**
     * Handle the Medicine "deleted" event.
     */
    public function deleted(Medicine $medicine): void
    {
        $action = [
            'action' => 'deleted the ' . $medicine->name . " record",
            'color' => '#ef4444',
            'icon' => 'pi pi-trash',
            'status' => 'Delete'
        ];
        MedicineProcessed::dispatch($medicine, $action, 'medicine');
    }

    /**
     * Handle the Medicine "restored" event.
     */
    public function restored(Medicine $medicine): void
    {
        //
    }

    /**
     * Handle the Medicine "force deleted" event.
     */
    public function forceDeleted(Medicine $medicine): void
    {
        //
    }
}
