<?php

namespace App\Observers;

use App\Events\JournalProcessed;
use App\Models\Journal;

class JournalObserver
{
    /**
     * Handle the journals "created" event.
     */
    public function created(Journal $journal): void
    {
        $action = [
            'action' => 'created the journal',
            'color' => '#22c55e',
            'icon' => 'pi pi-plus',
            'status' => 'Create'
        ];
        JournalProcessed::dispatch($journal, $action, 'journal');
    }

    /**
     * Handle the journals "updated" event.
     */
    public function updated(Journal $journal): void
    {
        $action = $this->getAction($journal);
        JournalProcessed::dispatch($journal, $action, 'journal');
    }

    /**
     * Handle the journals "deleted" event.
     */
    public function deleted(Journal $journal): void
    {
        $action = [
            'action' => 'delete the journal',
            'color' => '#ef4444',
            'icon' => 'pi pi-trash',
            'status' => 'Delete'
        ];
        JournalProcessed::dispatch($journal, $action, 'journal');
    }

    /**
     * Handle the journals "restored" event.
     */
    public function restored(Journal $journal): void
    {
        //
    }

    /**
     * Handle the journals "force deleted" event.
     */
    public function forceDeleted(Journal $journal): void
    {
        //
    }

    private function getAction($journal)
    {
        $action = '';
        if ($journal->is_favorite == 1 && $journal->getOriginal('is_favorite') == 0) {
            $action = [
                'action' => 'added journal as a favorite',
                'color' => '#f97316',
                'icon' => 'pi pi-star-fill',
                'status' => 'Favorite'
            ];
        } else if ($journal->is_favorite == 0 && $journal->getOriginal('is_favorite') == 1) {
            $action = [
                'action' => 'remove journal as a favorite',
                'color' => '#f97316',
                'icon' => 'pi pi-star',
                'status' => 'Removed'
            ];
        } else if ($journal->is_lock == 1 && $journal->getOriginal('is_lock') == 0) {
            $action = [
                'action' => 'unlocked the journal',
                'color' => '#a855f7',
                'icon' => 'pi pi-lock',
                'status' => 'Lock'
            ];
        } else if ($journal->is_lock == 0 && $journal->getOriginal('is_lock') == 1) {
            $action = [
                'action' => 'unlocked the journal',
                'color' => '#a855f7',
                'icon' => 'pi pi-lock-open',
                'status' => 'Unlock'
            ];
        } else {
            $action = [
                'action' => 'updated the journal',
                'color' => '#0ea5e9',
                'icon' => 'pi pi-file-edit',
                'status' => 'Update'
            ];
        }

        return $action;
    }
}
