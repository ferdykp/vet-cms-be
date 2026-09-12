<?php
namespace App\Models; use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;
class NavigationItem extends Model { use HasFactory; protected $fillable=['parent_id','label','type','reference_id','url','target','is_active','sort_order']; protected function casts(): array { return ['is_active'=>'boolean']; } public function parent(){ return $this->belongsTo(NavigationItem::class,'parent_id'); } public function children(){ return $this->hasMany(NavigationItem::class,'parent_id')->orderBy('sort_order'); } }
