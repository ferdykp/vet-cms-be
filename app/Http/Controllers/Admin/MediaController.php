<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Page;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(Request $request): View
    {
        $media = Media::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($q) use ($search) {
                    $q->where('original_name', 'like', "%{$search}%")
                        ->orWhere('alt_text', 'like', "%{$search}%");
                });
            })
            ->when($request->filter === 'images', fn ($q) => $q->where('mime_type', 'like', 'image/%'))
            ->when($request->filter === 'documents', fn ($q) => $q->where('mime_type', 'not like', 'image/%'))
            ->latest()
            ->paginate(30)
            ->withQueryString();

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'files' => ['required', 'array', 'max:20'],
            'files.*' => ['file', 'max:20480', 'mimes:jpg,jpeg,png,webp,gif,pdf,doc,docx'],
        ]);

        $created = [];

        foreach ($request->file('files', []) as $file) {
            $directory = 'media/'.now()->format('Y/m');
            $extension = strtolower($file->guessExtension());
            $fileName = Str::uuid().($extension ? ".{$extension}" : '');
            $path = $file->storeAs($directory, $fileName, 'public');

            [$width, $height] = $this->imageDimensions($file->getRealPath(), $file->getMimeType());

            $created[] = Media::create([
                'uploaded_by' => $request->user()?->id,
                'disk' => 'public',
                'directory' => $directory,
                'file_name' => $fileName,
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'extension' => $extension ?: null,
                'size' => $file->getSize(),
                'width' => $width,
                'height' => $height,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Media berhasil diunggah.',
                'data' => $created,
            ], 201);
        }

        return back()->with('success', count($created).' media berhasil diunggah.');
    }

    public function update(Request $request, Media $media): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string'],
        ]);

        $media->update($data);

        if ($request->expectsJson()) {
            return response()->json(['data' => $media->fresh()]);
        }

        return back()->with('success', 'Informasi media berhasil diperbarui.');
    }

    public function destroy(Media $media): RedirectResponse|JsonResponse
    {
        if ($this->isInUse($media)) {
            $message = 'Media masih digunakan pada konten atau profil dan tidak dapat dihapus.';

            return request()->expectsJson()
                ? response()->json(['message' => $message], 422)
                : back()->with('error', $message);
        }

        Storage::disk($media->disk)->delete($media->path);
        $media->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Media berhasil dihapus.']);
        }

        return back()->with('success', 'Media berhasil dihapus.');
    }

    private function imageDimensions(string $path, ?string $mime): array
    {
        if (! $mime || ! str_starts_with($mime, 'image/')) {
            return [null, null];
        }

        $size = @getimagesize($path);

        return $size ? [$size[0], $size[1]] : [null, null];
    }

    private function isReferencedInContent(Media $media): bool
    {
        foreach ([Post::class, Page::class] as $model) {
            foreach ($model::withTrashed()->select('id', 'content')->cursor() as $record) {
                $found = false;
                $content = $record->content ?? [];
                array_walk_recursive($content, function ($value) use ($media, &$found) {
                    if (is_string($value) && in_array($value, [$media->url, $media->path, '/storage/'.$media->path], true)) {
                        $found = true;
                    }
                });
                if ($found) {
                    return true;
                }
            }
        }

        return false;
    }

    private function isInUse(Media $media): bool
    {
        return $this->isReferencedInContent($media)
            || Post::withTrashed()->where('featured_media_id', $media->id)->exists()
            || Page::withTrashed()->where('featured_media_id', $media->id)->exists()
            || Profile::where('profile_photo_id', $media->id)->exists()
            || Profile::where('hero_photo_id', $media->id)->exists()
            || \App\Models\Resource::where('image_id', $media->id)->exists();
    }
}
