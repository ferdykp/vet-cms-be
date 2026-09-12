<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = Setting::where('is_public', true)
            ->get()
            ->groupBy('group')
            ->map(fn ($group) => $group->mapWithKeys(
                fn ($setting) => [$setting->key => $setting->typed_value]
            ));

        return response()->json(['data' => $settings]);
    }
}
