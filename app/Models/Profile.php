<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $fillable = ['user_id', 'profile_photo_id', 'hero_photo_id', 'full_name', 'professional_title', 'headline', 'short_bio', 'biography', 'email', 'phone', 'location', 'clinical_interests', 'social_links'];
    protected function casts(): array
    {
        return ['clinical_interests' => 'array', 'social_links' => 'array'];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profilePhoto()
    {
        return $this->belongsTo(Media::class, 'profile_photo_id');
    }
    public function heroPhoto()
    {
        return $this->belongsTo(Media::class, 'hero_photo_id');
    }
    public function educations()
    {
        return $this->hasMany(Education::class)->orderBy('sort_order');
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('sort_order');
    }
    public function certifications()
    {
        return $this->hasMany(Certification::class)->orderBy('sort_order');
    }
    public function publications()
    {
        return $this->hasMany(Publication::class)->orderBy('sort_order');
    }
    public function speakingEvents()
    {
        return $this->hasMany(SpeakingEvent::class)->orderBy('sort_order');
    }
    public function memberships()
    {
        return $this->hasMany(Membership::class)->orderBy('sort_order');
    }
}
