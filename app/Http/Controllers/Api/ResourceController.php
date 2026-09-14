<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $resources = Resource::active()
            ->with('image')
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->type))
            ->orderBy('sort_order')
            ->latest()
            ->paginate(max(1, min($request->integer('per_page', 12), 50)));

        return response()->json($resources);
    }

    public function show(string $slug): JsonResponse
    {
        $resource = Resource::active()
            ->with('image')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json(['data' => $resource]);
    }
}
