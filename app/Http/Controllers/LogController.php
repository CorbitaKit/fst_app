<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function getJournalLogs($journal_id)
    {
        $logs = Log::with('user')->where('record', 'journal')->where('record_id', $journal_id)->get();
        return response(json_encode($logs), 200);
    }
}
