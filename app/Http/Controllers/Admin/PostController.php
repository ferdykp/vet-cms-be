<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Media;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::query()
            ->with(['author', 'category', 'featuredMedia', 'tags'])
            ->latest('updated_at');

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $posts = $query->paginate(15)->withQueryString();
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create(Request $request): View
    {
        $type = in_array($request->query('type'), [
            'article', 'clinical_case', 'quick_note', 'story',
        ], true) ? $request->query('type') : 'article';

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $tags = Tag::orderBy('name')->get();
        $media = Media::latest()->limit(50)->get();

        return view('admin.posts.create', compact(
            'type', 'categories', 'tags', 'media'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        $post = DB::transaction(function () use ($request, $validated) {
            $tags = $validated['tags'] ?? [];
            unset($validated['tags']);

            $validated['author_id'] = $request->user()->id;
            $validated['slug'] = $this->uniqueSlug($validated['title'], $validated['slug'] ?? null);
            $validated['reading_time'] = $this->calculateReadingTime($validated['content'] ?? []);
            $validated = $this->normalizePublishingState($validated);

            $post = Post::create($validated);
            $post->tags()->sync($tags);

            return $post;
        });

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('success', 'Konten berhasil dibuat.');
    }

    public function edit(Post $post): View
    {
        $post->load(['tags', 'category', 'featuredMedia']);

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $tags = Tag::orderBy('name')->get();
        $media = Media::latest()->limit(50)->get();

        return view('admin.posts.edit', compact(
            'post', 'categories', 'tags', 'media'
        ));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $this->validatedData($request, $post);

        DB::transaction(function () use ($validated, $post) {
            $tags = $validated['tags'] ?? [];
            unset($validated['tags']);

            $validated['slug'] = $this->uniqueSlug(
                $validated['title'],
                $validated['slug'] ?? null,
                $post->id
            );

            $validated['reading_time'] = $this->calculateReadingTime($validated['content'] ?? []);
            $validated = $this->normalizePublishingState($validated, $post);

            $post->update($validated);
            $post->tags()->sync($tags);
        });

        return back()->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Konten dipindahkan ke trash.');
    }

    public function duplicate(Post $post): RedirectResponse
    {
        $copy = DB::transaction(function () use ($post) {
            $post->load('tags');

            $copy = $post->replicate([
                'slug', 'status', 'published_at', 'scheduled_at',
                'view_count', 'created_at', 'updated_at', 'deleted_at',
            ]);

            $copy->title = $post->title . ' (Copy)';
            $copy->slug = $this->uniqueSlug($copy->title);
            $copy->status = 'draft';
            $copy->published_at = null;
            $copy->scheduled_at = null;
            $copy->view_count = 0;
            $copy->save();

            $copy->tags()->sync($post->tags->pluck('id'));

            return $copy;
        });

        return redirect()
            ->route('admin.posts.edit', $copy)
            ->with('success', 'Konten berhasil diduplikasi sebagai draft.');
    }

    public function publish(Post $post): RedirectResponse
    {
        $post->update([
            'status' => 'published',
            'visibility' => 'public',
            'published_at' => $post->published_at ?? now(),
            'scheduled_at' => null,
        ]);

        return back()->with('success', 'Konten berhasil dipublikasikan.');
    }

    public function unpublish(Post $post): RedirectResponse
    {
        $post->update([
            'status' => 'draft',
            'scheduled_at' => null,
        ]);

        return back()->with('success', 'Konten dikembalikan menjadi draft.');
    }

    private function validatedData(Request $request, ?Post $post = null): array
    {
        return $request->validate([
            'type' => ['required', Rule::in(['article', 'clinical_case', 'quick_note', 'story'])],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'array'],
            'case_data' => ['nullable', 'array'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'featured_media_id' => ['nullable', 'exists:media,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
            'status' => ['required', Rule::in(['draft', 'scheduled', 'published', 'archived'])],
            'visibility' => ['required', Rule::in(['public', 'private'])],
            'scheduled_at' => ['nullable', 'date', Rule::requiredIf(fn () => $request->input('status') === 'scheduled'), 'after:now'],
            'published_at' => ['nullable', 'date'],
            'is_featured' => ['nullable', 'boolean'],
            'allow_indexing' => ['nullable', 'boolean'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'url', 'max:2048'],
        ]);
    }

    private function normalizePublishingState(array $data, ?Post $post = null): array
    {
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['allow_indexing'] = (bool) ($data['allow_indexing'] ?? true);

        if ($data['status'] === 'published') {
            $data['published_at'] = $data['published_at']
                ?? $post?->published_at
                ?? now();
            $data['scheduled_at'] = null;
        }

        if ($data['status'] === 'scheduled') {
            $data['published_at'] = null;
        }

        if (in_array($data['status'], ['draft', 'archived'], true)) {
            $data['scheduled_at'] = null;
        }

        return $data;
    }


    private function calculateReadingTime(array $content): int
    {
        $blocks = $content['blocks'] ?? $content;
        $text = collect(is_array($blocks) ? $blocks : [])
            ->map(function ($block) {
                $data = is_array($block) ? ($block['data'] ?? []) : [];
                return collect(is_array($data) ? $data : [])->values()->implode(' ');
            })
            ->implode(' ');

        $words = str_word_count(strip_tags($text));
        return max(1, (int) ceil($words / 200));
    }

    private function uniqueSlug(string $title, ?string $requested = null, ?int $ignoreId = null): string
    {
        $base = Str::slug($requested ?: $title) ?: Str::random(8);
        $slug = $base;
        $counter = 2;

        while (Post::withTrashed()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}
