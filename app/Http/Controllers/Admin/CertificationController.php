<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $profile = Profile::where('user_id', $request->user()->id)->firstOrFail();

        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'issuer' => ['nullable','string','max:255'],
            'year' => ['nullable','integer','min:1900','max:2100'],
            'credential_id' => ['nullable','string','max:255'],
            'credential_url' => ['nullable','url','max:2048'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $profile->certifications()->create($data);

        return back()->with('success', 'Certification berhasil ditambahkan.');
    }

    public function update(Request $request, Certification $certification): RedirectResponse
    {
        $this->assertOwnership($request, $certification);

        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'issuer' => ['nullable','string','max:255'],
            'year' => ['nullable','integer','min:1900','max:2100'],
            'credential_id' => ['nullable','string','max:255'],
            'credential_url' => ['nullable','url','max:2048'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $certification->update($data);

        return back()->with('success', 'Certification berhasil diperbarui.');
    }

    public function destroy(Request $request, Certification $certification): RedirectResponse
    {
        $this->assertOwnership($request, $certification);
        $certification->delete();

        return back()->with('success', 'Certification berhasil dihapus.');
    }

    private function assertOwnership(Request $request, Certification $certification): void
    {
        abort_unless(
            $certification->profile()->where('user_id', $request->user()->id)->exists(),
            403
        );
    }
}
