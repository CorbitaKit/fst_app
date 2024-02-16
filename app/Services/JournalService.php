<?php

namespace App\Services;

use App\Models\Journal;
use Illuminate\Database\Eloquent\Collection;

class JournalService
{
    public function doStore(array $journal): Journal
    {
        $journal['created_by'] = auth()->id();

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
        return Journal::withoutTrashed()->get();
    }

    public function doGetCitizenJournals(int $citizen_id): Collection
    {
        return Journal::with('creator')->where('citizen_id', $citizen_id)->get();
    }
}
