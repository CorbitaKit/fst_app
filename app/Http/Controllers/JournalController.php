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
        return response(json_encode('Updated'), 200);
    }

    // public function destroy($journalId)
    // {
    //     $this->journalService->doDestroy($journalId);
    //     return response(json_encode('Deleted'), 204);
    // }

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

    public function addJournalToFavorite($journal_id)
    {
        $this->journalService->doAddJournalToFavorite($journal_id);
    }

    public function lockJournal($journal_id)
    {
        $this->journalService->doLockJournal($journal_id);
    }
}
