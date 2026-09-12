<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ResourceController extends Controller
{
    public function index(Request $request): View
    {
        $resources = Resource::query()
            ->with('image')
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->type))
            ->orderBy('sort_order')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.resources.index', compact('resources'));
    }

    public function create(): View
    {
        return view('admin.resources.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($data['title'], $data['slug'] ?? null);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['is_active'] = (bool) ($data['is_active'] ?? true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Resource::create($data);

        return redirect()->route('admin.resources.index')->with('success', 'Resource berhasil ditambahkan.');
    }

    public function edit(Resource $resource): View
    {
        return view('admin.resources.edit', compact('resource'));
    }

    public function update(Request $request, Resource $resource): RedirectResponse
    {
        $data = $this->validateData($request, $resource);
        $data['slug'] = $this->uniqueSlug($data['title'], $data['slug'] ?? null, $resource->id);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $resource->update($data);

        return back()->with('success', 'Resource berhasil diperbarui.');
    }

    public function destroy(Resource $resource): RedirectResponse
    {
        $resource->delete();
        return back()->with('success', 'Resource berhasil dihapus.');
    }

    private function validateData(Request $request, ?Resource $resource = null): array
    {
        return $request->validate([
            'image_id' => ['nullable', 'exists:media,id'],
            'type' => ['required', Rule::in(['book','research_paper','equipment','course','website','tool','other'])],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'url' => ['nullable', 'url', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function uniqueSlug(string $title, ?string $requested = null, ?int $ignoreId = null): string
    {
        $base = Str::slug($requested ?: $title) ?: Str::random(8);
        $slug = $base;
        $i = 2;
        while (Resource::when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}
