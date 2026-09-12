<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $profile = Profile::where('user_id', $request->user()->id)->firstOrFail();

        $data = $request->validate([
            'degree' => ['required','string','max:255'],
            'institution' => ['required','string','max:255'],
            'field_of_study' => ['nullable','string','max:255'],
            'start_year' => ['nullable','integer','min:1900','max:2100'],
            'end_year' => ['nullable','integer','min:1900','max:2100'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $profile->educations()->create($data);

        return back()->with('success', 'Education berhasil ditambahkan.');
    }

    public function update(Request $request, Education $education): RedirectResponse
    {
        $this->assertOwnership($request, $education);

        $data = $request->validate([
            'degree' => ['required','string','max:255'],
            'institution' => ['required','string','max:255'],
            'field_of_study' => ['nullable','string','max:255'],
            'start_year' => ['nullable','integer','min:1900','max:2100'],
            'end_year' => ['nullable','integer','min:1900','max:2100'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $education->update($data);

        return back()->with('success', 'Education berhasil diperbarui.');
    }

    public function destroy(Request $request, Education $education): RedirectResponse
    {
        $this->assertOwnership($request, $education);
        $education->delete();

        return back()->with('success', 'Education berhasil dihapus.');
    }

    private function assertOwnership(Request $request, Education $education): void
    {
        abort_unless(
            $education->profile()->where('user_id', $request->user()->id)->exists(),
            403
        );
    }
}
