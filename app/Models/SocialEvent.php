<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialEvent extends Model
{
    use HasFactory;

    protected $table = 'social_events';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'publication_id',
        'starts_at',
        'ends_at',
        'description',
        'country_code',
        'longitude',
        'latitude',
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'publication_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'publication_id');
    }

    public function participants()
    {
        return $this->hasMany(EventParticipant::class, 'social_event_id');
    }
}
