<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function show(string $slug): JsonResponse
    {
        $page = Page::published()
            ->with('featuredMedia')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json(['data' => $page]);
    }
}
