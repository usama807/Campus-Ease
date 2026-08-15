<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $matchSensitivity = Setting::get('match_sensitivity_threshold', 40);
        $expirationDays = Setting::get('unclaimed_item_expiration_days', 60);

        return view('superadmin.settings.index', compact('matchSensitivity', 'expirationDays'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'match_sensitivity_threshold' => ['required', 'integer', 'min:0', 'max:100'],
            'unclaimed_item_expiration_days' => ['required', 'integer', 'min:1'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('superadmin.settings.index')
            ->with('status', 'Settings updated.');
    }
}
