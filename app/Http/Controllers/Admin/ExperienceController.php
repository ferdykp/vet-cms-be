<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $profile = Profile::where('user_id', $request->user()->id)->firstOrFail();

        $data = $request->validate([
            'position' => ['required','string','max:255'],
            'organization' => ['required','string','max:255'],
            'location' => ['nullable','string','max:255'],
            'start_date' => ['nullable','date'],
            'end_date' => ['nullable','date','after_or_equal:start_date'],
            'is_current' => ['nullable','boolean'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['is_current'] = (bool) ($data['is_current'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $profile->experiences()->create($data);

        return back()->with('success', 'Experience berhasil ditambahkan.');
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $this->assertOwnership($request, $experience);

        $data = $request->validate([
            'position' => ['required','string','max:255'],
            'organization' => ['required','string','max:255'],
            'location' => ['nullable','string','max:255'],
            'start_date' => ['nullable','date'],
            'end_date' => ['nullable','date','after_or_equal:start_date'],
            'is_current' => ['nullable','boolean'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['is_current'] = (bool) ($data['is_current'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $experience->update($data);

        return back()->with('success', 'Experience berhasil diperbarui.');
    }

    public function destroy(Request $request, Experience $experience): RedirectResponse
    {
        $this->assertOwnership($request, $experience);
        $experience->delete();

        return back()->with('success', 'Experience berhasil dihapus.');
    }

    private function assertOwnership(Request $request, Experience $experience): void
    {
        abort_unless(
            $experience->profile()->where('user_id', $request->user()->id)->exists(),
            403
        );
    }
}
