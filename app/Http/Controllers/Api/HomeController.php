<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        $profile = Profile::with(['profilePhoto', 'heroPhoto'])
            ->first();

        $featured = Post::published()
            ->featured()
            ->with(['author.profile', 'category', 'featuredMedia', 'tags'])
            ->latest('published_at')
            ->first();

        $latest = Post::published()
            ->with(['author.profile', 'category', 'featuredMedia', 'tags'])
            ->latest('published_at')
            ->limit(6)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount(['posts' => fn ($q) => $q->published()])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $resources = Resource::active()
            ->where('is_featured', true)
            ->with('image')
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return response()->json([
            'data' => [
                'profile' => $profile,
                'featured_post' => $featured,
                'latest_posts' => $latest,
                'categories' => $categories,
                'featured_resources' => $resources,
            ],
        ]);
    }
}
