<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditorialWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_archive_sorts_by_reading_time_and_clamps_page_size(): void
    {
        $this->freezeTime();
        $author = User::factory()->create();
        Post::create(['author_id' => $author->id, 'title' => 'Short newest', 'slug' => 'short', 'status' => 'published', 'visibility' => 'public', 'published_at' => now(), 'reading_time' => 2]);
        Post::create(['author_id' => $author->id, 'title' => 'Long older', 'slug' => 'long', 'status' => 'published', 'visibility' => 'public', 'published_at' => now()->subDay(), 'reading_time' => 20]);
        $this->getJson('/api/v1/posts?sort=readtime&per_page=0')->assertOk()->assertJsonPath('per_page', 1)->assertJsonPath('data.0.slug', 'long')->assertJsonPath('total', 2);
        $this->getJson('/api/v1/posts?sort=newest')->assertOk()->assertJsonPath('data.0.slug', 'short');
        $this->getJson('/api/v1/resources?per_page=-10')->assertOk()->assertJsonPath('per_page', 1);
    }

    public function test_editor_preserves_nested_lists_private_visibility_and_disabled_indexing(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'is_active' => true]);
        $content = ['blocks' => [['type' => 'list', 'data' => ['style' => 'ordered', 'items' => [['content' => trim(str_repeat('clinical ', 401)), 'items' => []]]]]]];
        $response = $this->actingAs($admin)->post('/admin/posts', ['type' => 'article', 'title' => 'Nested clinical list', 'content' => $content, 'status' => 'draft', 'visibility' => 'private', 'allow_indexing' => '0', 'scheduled_at' => '2020-01-01']);
        $post = Post::where('slug', 'nested-clinical-list')->firstOrFail();
        $response->assertRedirect(route('admin.posts.edit', $post));
        $this->assertSame($content, $post->content);
        $this->assertSame(3, $post->reading_time);
        $this->assertSame('private', $post->visibility);
        $this->assertFalse($post->allow_indexing);
        $this->assertNull($post->scheduled_at);
        $this->getJson('/api/v1/posts/nested-clinical-list')->assertNotFound();
    }

    public function test_scheduling_requires_a_future_date(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'is_active' => true]);
        $this->actingAs($admin)->postJson('/admin/posts', ['type' => 'article', 'title' => 'Scheduled note', 'status' => 'scheduled', 'visibility' => 'public'])->assertUnprocessable()->assertJsonValidationErrors('scheduled_at');
        $this->assertDatabaseCount('posts', 0);
    }

    public function test_media_referenced_inside_article_content_cannot_be_deleted(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin', 'is_active' => true]);
        $media = Media::create(['uploaded_by' => $admin->id, 'disk' => 'public', 'directory' => 'media', 'file_name' => 'slide.jpg', 'original_name' => 'slide.jpg', 'path' => 'media/slide.jpg', 'mime_type' => 'image/jpeg', 'size' => 20]);
        Storage::disk('public')->put($media->path, 'test image');
        Post::create(['author_id' => $admin->id, 'title' => 'Clinical image', 'slug' => 'clinical-image', 'content' => ['blocks' => [['type' => 'image', 'data' => ['url' => $media->url]]]]]);
        $this->actingAs($admin)->deleteJson('/admin/media/'.$media->id)->assertUnprocessable();
        $this->assertDatabaseHas('media', ['id' => $media->id]);
        Storage::disk('public')->assertExists($media->path);
    }

    public function test_upload_uses_content_extension_instead_of_original_suffix(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin', 'is_active' => true]);
        $handle = tmpfile();
        fwrite($handle, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII='));
        $file = new UploadedFile(stream_get_meta_data($handle)['uri'], 'scan.jpeg', 'image/jpeg', null, true);
        $this->actingAs($admin)->postJson('/admin/media', ['files' => [$file]])->assertCreated();
        $media = Media::firstOrFail();
        $this->assertSame('png', $media->extension);
        $this->assertStringEndsWith('.png', $media->path);
        fclose($handle);
        Storage::disk('public')->assertExists($media->path);
    }

    public function test_editor_pages_render_for_an_admin(): void
    {
        $this->withoutVite();
        $admin = User::factory()->create(['role' => 'admin', 'is_active' => true]);
        foreach (['dashboard', 'posts', 'posts/create?type=article', 'media', 'categories', 'pages/create'] as $path) {
            $this->actingAs($admin)->get('/admin/'.$path)->assertOk();
        }
    }
}
