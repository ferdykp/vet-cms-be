<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;
    protected $table = 'media';
    protected $fillable = ['uploaded_by', 'disk', 'directory', 'file_name', 'original_name', 'path', 'mime_type', 'extension', 'size', 'width', 'height', 'alt_text', 'caption'];
    protected $appends = ['url'];
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
    public function getUrlAttribute(): ?string
    {
        return $this->path ? Storage::disk($this->disk)->url($this->path) : null;
    }
}
