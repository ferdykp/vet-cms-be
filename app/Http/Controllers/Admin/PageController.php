<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::latest('updated_at')->paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    public function create(): View
    {
        return view('admin.pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['title'], $data['slug'] ?? null);
        $data = $this->normalizeStatus($data);
        $page = Page::create($data);

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Page berhasil dibuat.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['title'], $data['slug'] ?? null, $page->id);
        $data = $this->normalizeStatus($data, $page);
        $page->update($data);

        return back()->with('success', 'Page berhasil diperbarui.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();
        return back()->with('success', 'Page dipindahkan ke trash.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'featured_media_id' => ['nullable', 'exists:media,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'array'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
        ]);
    }

    private function normalizeStatus(array $data, ?Page $page = null): array
    {
        if ($data['status'] === 'published') {
            $data['published_at'] = $data['published_at'] ?? $page?->published_at ?? now();
        }
        return $data;
    }

    private function uniqueSlug(string $title, ?string $requested = null, ?int $ignoreId = null): string
    {
        $base = Str::slug($requested ?: $title) ?: Str::random(8);
        $slug = $base;
        $i = 2;
        while (Page::withTrashed()->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}
