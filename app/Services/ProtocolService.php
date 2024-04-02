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
            $start_date = Carbon::parse($protocolData['start_date']);
            $end_date = Carbon::parse($protocolData['end_date']);

            $dates = [];
            for ($date = $start_date->addDay(); $date->lte($end_date); $date->addDay()) {
                $dates[] = $date->format('Y-m-d');
            }
            $dates[] = $end_date->addDay()->format('Y-m-d');
            $protocolData['start_date'] = Carbon::parse($protocolData['start_date'])->format('Y-m-d');
            $protocolData['end_date'] = Carbon::parse($protocolData['end_date'])->format('Y-m-d');
            $protocolData['organizer_id'] = Auth::user()->id;

            $protocol = Protocol::create($protocolData);

            foreach ($dates as $date) {
                $protocol->citizens()->attach(
                    array_column($protocolData['citizens'], 'id'),
                    ['date' => $date, 'status' => 'Active']
                );
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }
}
