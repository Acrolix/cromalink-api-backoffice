<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'title',
        'content',
        'published_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [];

    public function published_by()
    {
        return $this->belongsTo(UserProfile::class, 'published_by', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id')->with('user');
    }

    public function social_events()
    {
        return $this->hasMany(SocialEvent::class, 'publication_id')->with('country');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'id')->with('user')->select('reaction_by', 'type');
    }
    public function resources()
    {
        return $this->hasMany(Resource::class, 'id');
    }
}
