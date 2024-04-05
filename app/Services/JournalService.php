<?php

namespace App\Services;

use App\Models\Journal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class JournalService
{
    public function doStore(array $journal): Journal
    {
        $journal['created_by'] = auth()->id();
        $journal['date'] = Carbon::parse($journal['date'])->format('Y-m-d');
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

    public function doGetSortedJournal(int $citizen_id, String $sort): Collection
    {
        return Journal::with('creator')->where('citizen_id', $citizen_id)->orderBy('created_at', $sort)->get();
    }

    public function doGetFilteredJournal(int $citizen_id, String $field): Collection
    {
        return Journal::with('creator')->where('citizen_id', $citizen_id)->where($field, 1)->get();
    }

    public function dofilterJournalDateRange(array $dateRange): Collection
    {
        $start_date = Carbon::parse($dateRange[0])->format('Y-m-d');
        $end_date = Carbon::parse($dateRange[1])->format('Y-m-d');
        return Journal::with('creator')->whereBetween('created_at', [$start_date, $end_date])->get();
    }
}
