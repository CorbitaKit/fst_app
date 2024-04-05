<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JournalRequest;
use App\Services\JournalService;
use Inertia\Inertia;

class JournalController extends Controller
{
    private $journalService;

    public function __construct(JournalService $journalService)
    {
        $this->journalService = $journalService;
    }

    public function index()
    {
        $journals = $this->journalService->doGet();
        return response(json_encode($journals), 200);
    }
    public function store(JournalRequest $request)
    {
        $this->journalService->doStore($request->all());
    }

    public function update(Request $request, $journalId)
    {
        $this->journalService->doUpdate($request->all(), $journalId);
    }


    public function show($journalId)
    {
        $journal = $this->journalService->doGetJournal($journalId);

        return response(json_encode($journal), 200);
    }

    public function destroy($journal_id)
    {
        $this->journalService->doDestroy($journal_id);
        return response(json_encode('Deleted'), 204);
    }

    public function getCitizenJournal($citizen_id)
    {
        $journals = $this->journalService->doGetCitizenJournals($citizen_id);

        return response(json_encode($journals), 200);
    }

    public function getSortedJournal($citizen_id, $sort)
    {
        $journals = $this->journalService->doGetSortedJournal($citizen_id, $sort);
        return response(json_encode($journals), 200);
    }

    public function getFilteredJournal($citizen_id, $field)
    {
        $journals = $this->journalService->doGetFilteredJournal($citizen_id, $field);
        return response(json_encode($journals), 200);
    }

    public function filterJournalDateRange($dateRange)
    {
        $journals = $this->journalService->dofilterJournalDateRange(json_decode($dateRange));

        return response(json_encode($journals), 200);
    }
}
