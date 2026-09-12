<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Media;
use App\Models\Post;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'published' => Post::published()->count(),
            'drafts' => Post::where('status', 'draft')->count(),
            'categories' => Category::where('is_active', true)->count(),
            'media' => Media::count(),
        ];

        $recentDrafts = Post::query()
            ->with(['category', 'featuredMedia'])
            ->where('status', 'draft')
            ->latest('updated_at')
            ->limit(5)
            ->get();

        $recentPublished = Post::published()
            ->with(['category', 'featuredMedia'])
            ->latest('published_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentDrafts',
            'recentPublished'
        ));
    }
}
