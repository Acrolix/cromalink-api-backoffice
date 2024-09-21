<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    protected $table = "social_event_participants";
    public $timestamps = false;

    protected $fillable = [
        'social_event_id',
        'participant_id',
    ];


    public function social_event()
    {
        return $this->belongsTo(SocialEvent::class, 'social_event_id');
    }

    public function participant()
    {
        return $this->belongsTo(UserProfile::class, 'participant_id', 'user_id');
    }
}
