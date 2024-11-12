<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profile';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'username',
        'first_name',
        'last_name',
        'biography',
        'birth_date',
        'country_code',
        'avatar',
    ];

    protected $casts = [
        'birth_date' => 'datetime',
    ];

    protected $hidden = ['biography', 'birth_date'];
    protected $appends = [
        'fullName',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }

    public function social_events()
    {
        return $this->hasMany(SocialEvent::class, 'publication_id')->with('participants');
    }

    public function publications()
    {
        return $this->hasMany(Publication::class, 'published_by', 'user_id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'reaction_by', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'published_by', 'user_id');
    }

    public function resources()
    {
        return $this->hasMany(Resource::class, 'resource_by');
    }
}
