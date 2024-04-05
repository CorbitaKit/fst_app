<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'settings/index',
            [
                'settings' => Setting::where('company_id', Auth::user()->employee->company_id)->first()
            ]
        );
    }

    public function updateFeature($settingsId, $feature, $status)
    {
        $settings = Setting::findOrFail($settingsId);
        $settings->update([$feature => $status]);
    }
}
