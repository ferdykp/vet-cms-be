<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        $profile = Profile::with([
            'profilePhoto',
            'heroPhoto',
            'educations',
            'experiences',
            'certifications',
            'publications',
            'speakingEvents',
            'memberships',
        ])->firstOrFail();

        return response()->json(['data' => $profile]);
    }
}
