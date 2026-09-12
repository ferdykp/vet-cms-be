<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;
    protected $table = 'certifications';
    protected $fillable = ['profile_id', 'name', 'issuer', 'year', 'credential_id', 'credential_url', 'sort_order'];
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
