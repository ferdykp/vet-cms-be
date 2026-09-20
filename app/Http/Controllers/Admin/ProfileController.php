<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $profile = Profile::firstOrCreate(
            ['user_id' => $request->user()->id],
            ['full_name' => $request->user()->name],
            ['short_name' => $request->user()->short_name]
        );

        $profile->load([
            'profilePhoto',
            'heroPhoto',
            'educations',
            'experiences',
            'certifications',
            'publications',
            'speakingEvents',
            'memberships',
        ]);

        $media = Media::where('mime_type', 'like', 'image/%')->latest()->limit(100)->get();

        return view('admin.profile.edit', compact('profile', 'media'));
    }

    public function update(Request $request): RedirectResponse
    {
        $profile = Profile::firstOrCreate(
            ['user_id' => $request->user()->id],
            ['full_name' => $request->user()->name],
            ['short_name' => $request->user()->short_name]

        );

        $data = $request->validate([
            'profile_photo_id' => ['nullable', 'exists:media,id'],
            'hero_photo_id' => ['nullable', 'exists:media,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'short_name' => ['required', 'string', 'max:255'],
            'professional_title' => ['nullable', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'short_bio' => ['nullable', 'string', 'max:1000'],
            'biography' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'clinical_interests' => ['nullable', 'array'],
            'clinical_interests.*' => ['string', 'max:100'],
            'social_links' => ['nullable', 'array'],
        ]);

        $profile->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
