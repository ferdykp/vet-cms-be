<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;
    protected $fillable = ['image_id', 'type', 'title', 'slug', 'description', 'url', 'is_featured', 'is_active', 'sort_order'];
    protected function casts(): array
    {
        return ['is_featured' => 'boolean', 'is_active' => 'boolean'];
    }
    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
