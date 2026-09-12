<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $profile = Profile::where('user_id', $request->user()->id)->firstOrFail();

        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'publisher' => ['nullable','string','max:255'],
            'year' => ['nullable','integer','min:1900','max:2100'],
            'url' => ['nullable','url','max:2048'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $profile->publications()->create($data);

        return back()->with('success', 'Publication berhasil ditambahkan.');
    }

    public function update(Request $request, Publication $publication): RedirectResponse
    {
        $this->assertOwnership($request, $publication);

        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'publisher' => ['nullable','string','max:255'],
            'year' => ['nullable','integer','min:1900','max:2100'],
            'url' => ['nullable','url','max:2048'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $publication->update($data);

        return back()->with('success', 'Publication berhasil diperbarui.');
    }

    public function destroy(Request $request, Publication $publication): RedirectResponse
    {
        $this->assertOwnership($request, $publication);
        $publication->delete();

        return back()->with('success', 'Publication berhasil dihapus.');
    }

    private function assertOwnership(Request $request, Publication $publication): void
    {
        abort_unless(
            $publication->profile()->where('user_id', $request->user()->id)->exists(),
            403
        );
    }
}
