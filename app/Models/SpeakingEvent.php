<?php
namespace App\Models; use Illuminate\Database\Eloquent\Factories\HasFactory; use Illuminate\Database\Eloquent\Model;
class SpeakingEvent extends Model { use HasFactory; protected $table='speaking_events'; protected $fillable=['profile_id','event_name','topic','location','event_date','url','description','sort_order']; protected function casts(): array { return ['event_date'=>'date']; } public function profile(){ return $this->belongsTo(Profile::class); } }
