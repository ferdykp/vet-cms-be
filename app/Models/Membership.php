<?php
namespace App\Models; use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;
class Membership extends Model { use HasFactory; protected $table='memberships'; protected $fillable=['profile_id','organization','role','url','description','sort_order'];  public function profile(){ return $this->belongsTo(Profile::class); } }
