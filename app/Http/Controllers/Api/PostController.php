<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $posts = Post::published()
            ->with(['author.profile.profilePhoto', 'category', 'featuredMedia', 'tags'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
            })
            ->when($request->filled('tag'), function ($query) use ($request) {
                $query->whereHas('tags', fn ($q) => $q->where('slug', $request->tag));
            })
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->type))
            ->latest('published_at')
            ->paginate(min($request->integer('per_page', 12), 50))
            ->withQueryString();

        return response()->json($posts);
    }

    public function show(string $slug): JsonResponse
    {
        $post = Post::published()
            ->with(['author.profile.profilePhoto', 'category', 'featuredMedia', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        $post->increment('view_count');

        $related = Post::published()
            ->whereKeyNot($post->id)
            ->when($post->category_id, fn ($q) => $q->where('category_id', $post->category_id))
            ->with(['category', 'featuredMedia'])
            ->latest('published_at')
            ->limit(3)
            ->get();

        return response()->json([
            'data' => $post->fresh(['author.profile.profilePhoto', 'category', 'featuredMedia', 'tags']),
            'related' => $related,
        ]);
    }
}
