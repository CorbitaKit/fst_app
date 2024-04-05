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
            $protocolData['company_id'] = Auth::user()->employee->company_id;

            $protocol = Protocol::create($protocolData);

            foreach ($dates as $date) {
                $protocol->citizens()->attach(
                    array_column($protocolData['citizens'], 'id'),
                    ['date' => $date, 'status' => '-']
                );
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function doFilterProtocol(array $filter): Collection
    {
        $start_date = Carbon::parse($filter['start_date'])->format('Y-m-d');
        $end_date = Carbon::parse($filter['end_date'])->format('Y-m-d');
        $citizenIds = array_column($filter['citizens'], 'id');
        $protocols = Protocol::with('citizens')->where('start_date', '>=', $start_date)
            ->where('end_date', '<=', $end_date)
            ->whereHas('citizens', function ($query) use ($citizenIds) {
                $query->whereIn('citizen_id', $citizenIds);
            })
            ->get();

        return $protocols;
    }

    public function doGetCitizenProtocols($citizenId): Collection
    {
        return Protocol::with('citizens')->whereHas('citizens', function ($query) use ($citizenId) {
            $query->where('citizen_id', $citizenId);
        })->get();
    }
}
