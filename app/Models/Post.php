<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['author_id', 'category_id', 'featured_media_id', 'type', 'title', 'slug', 'excerpt', 'content', 'case_data', 'status', 'visibility', 'seo_title', 'seo_description', 'canonical_url', 'published_at', 'scheduled_at', 'reading_time', 'view_count', 'is_featured', 'allow_indexing'];
    protected function casts(): array
    {
        return ['content' => 'array', 'case_data' => 'array', 'published_at' => 'datetime', 'scheduled_at' => 'datetime', 'is_featured' => 'boolean', 'allow_indexing' => 'boolean', 'view_count' => 'integer', 'reading_time' => 'integer'];
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function featuredMedia()
    {
        return $this->belongsTo(Media::class, 'featured_media_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')->where('visibility', 'public')->whereNotNull('published_at')->where('published_at', '<=', now());
    }
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
    public function scopeType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
