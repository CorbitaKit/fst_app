<?php

namespace App\Services;

use App\Models\Journal;

class JournalService
{
    public function doStore(array $journal): Journal
    {
        return Journal::create($journal);
    }

    public function doUpdate(array $journalData, int $journalId): bool
    {
        $journal = Journal::findOrFail($journalId);
        return $journal->update($journalData);
    }

    public function doDestroy(int $journalId): bool
    {
        return Journal::findOrFail($journalId)->delete();
    }

    public function doGetJournal($journalId): Journal
    {
        return Journal::where('id', $journalId)->first();
    }

    public function doGet(): Journal
    {
        return Journal::get();
    }

    public function doAddJournalToFavorite($journal_id): void
    {
        $journal = Journal::findOrFail($journal_id);
        $journal->update(['is_favorite' => 1]);
    }

    public function doLockJournal($journal_id): void
    {
        $journal = Journal::findOrFail($journal_id);
        $journal->update(['is_lock' => 1]);
    }
}
