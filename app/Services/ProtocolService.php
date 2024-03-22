<?php

namespace App\Services;

use App\Models\Protocol;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProtocolService
{
    public function doGet(): Collection
    {
        return Protocol::with('citizens')->get();
    }

    public function doStore(array $protocolData): void
    {
        DB::beginTransaction();
        try {
            $protocolData['start_date'] = Carbon::parse($protocolData['start_date'])->format('Y-m-d');
            $protocolData['end_date'] = Carbon::parse($protocolData['end_date'])->format('Y-m-d');
            $protocolData['organizer_id'] = Auth::user()->id;

            $protocol = Protocol::create($protocolData);
            $protocol->citizens()->attach(array_column($protocolData['citizens'], 'id'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }
}
