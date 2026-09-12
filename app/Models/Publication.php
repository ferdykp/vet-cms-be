<?php
namespace App\Models; use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;
class Publication extends Model { use HasFactory; protected $table='publications'; protected $fillable=['profile_id','title','publisher','year','url','description','sort_order'];  public function profile(){ return $this->belongsTo(Profile::class); } }
