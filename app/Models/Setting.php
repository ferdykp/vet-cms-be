<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['group', 'key', 'value', 'type', 'is_public'];
    protected function casts(): array
    {
        return ['is_public' => 'boolean'];
    }
    public function getTypedValueAttribute()
    {
        return match ($this->type) {
            'boolean' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int)$this->value,
            'float' => (float)$this->value,
            'json' => json_decode($this->value, true),
            default => $this->value
        };
    }
}
