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
        JournalProcessed::dispatch($journal, 'created the journal', 'journal');
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
        JournalProcessed::dispatch($journal, 'deleted the journal', 'journal');
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
            $action = 'Added journal to favorite';
        } else if ($journal->is_favorite == 0 && $journal->getOriginal('is_favorite') == 1) {
            $action = 'Removed journal to favorite';
        } else if ($journal->is_lock == 1 && $journal->getOriginal('is_lock') == 0) {
            $action = 'Locked the journal';
        } else if ($journal->is_lock == 0 && $journal->getOriginal('is_lock') == 1) {
            $action = 'Unlocked the journal';
        } else {
            $action = 'updated the journal';
        }

        return $action;
    }
}
