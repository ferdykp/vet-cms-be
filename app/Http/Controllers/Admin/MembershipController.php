<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $profile = Profile::where('user_id', $request->user()->id)->firstOrFail();

        $data = $request->validate([
            'organization' => ['required','string','max:255'],
            'role' => ['nullable','string','max:255'],
            'url' => ['nullable','url','max:2048'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $profile->memberships()->create($data);

        return back()->with('success', 'Membership berhasil ditambahkan.');
    }

    public function update(Request $request, Membership $membership): RedirectResponse
    {
        $this->assertOwnership($request, $membership);

        $data = $request->validate([
            'organization' => ['required','string','max:255'],
            'role' => ['nullable','string','max:255'],
            'url' => ['nullable','url','max:2048'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $membership->update($data);

        return back()->with('success', 'Membership berhasil diperbarui.');
    }

    public function destroy(Request $request, Membership $membership): RedirectResponse
    {
        $this->assertOwnership($request, $membership);
        $membership->delete();

        return back()->with('success', 'Membership berhasil dihapus.');
    }

    private function assertOwnership(Request $request, Membership $membership): void
    {
        abort_unless(
            $membership->profile()->where('user_id', $request->user()->id)->exists(),
            403
        );
    }
}
