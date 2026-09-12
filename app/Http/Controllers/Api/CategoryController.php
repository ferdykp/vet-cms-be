<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::where('is_active', true)
            ->withCount(['posts' => fn ($q) => $q->published()])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json(['data' => $categories]);
    }

    public function show(string $slug): JsonResponse
    {
        $category = Category::where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $posts = $category->posts()
            ->published()
            ->with(['author.profile.profilePhoto', 'featuredMedia', 'tags'])
            ->latest('published_at')
            ->paginate(12);

        return response()->json([
            'data' => $category,
            'posts' => $posts,
        ]);
    }
}
