<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpeakingEvent;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SpeakingEventController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $profile = Profile::where('user_id', $request->user()->id)->firstOrFail();

        $data = $request->validate([
            'event_name' => ['required','string','max:255'],
            'topic' => ['nullable','string','max:255'],
            'location' => ['nullable','string','max:255'],
            'event_date' => ['nullable','date'],
            'url' => ['nullable','url','max:2048'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $profile->speakingEvents()->create($data);

        return back()->with('success', 'SpeakingEvent berhasil ditambahkan.');
    }

    public function update(Request $request, SpeakingEvent $speakingEvent): RedirectResponse
    {
        $this->assertOwnership($request, $speakingEvent);

        $data = $request->validate([
            'event_name' => ['required','string','max:255'],
            'topic' => ['nullable','string','max:255'],
            'location' => ['nullable','string','max:255'],
            'event_date' => ['nullable','date'],
            'url' => ['nullable','url','max:2048'],
            'description' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0']
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $speakingEvent->update($data);

        return back()->with('success', 'SpeakingEvent berhasil diperbarui.');
    }

    public function destroy(Request $request, SpeakingEvent $speakingEvent): RedirectResponse
    {
        $this->assertOwnership($request, $speakingEvent);
        $speakingEvent->delete();

        return back()->with('success', 'SpeakingEvent berhasil dihapus.');
    }

    private function assertOwnership(Request $request, SpeakingEvent $speakingEvent): void
    {
        abort_unless(
            $speakingEvent->profile()->where('user_id', $request->user()->id)->exists(),
            403
        );
    }
}
