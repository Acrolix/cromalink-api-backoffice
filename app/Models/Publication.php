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

    public function published_by()
    {
        return $this->belongsTo(User::class, 'published_by')->with('user_profile');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'publication_id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'publication_id');
    }

    public function reactions_count()
    {
        return $this->hasMany(Reaction::class, 'publication_id')
                    ->selectRaw('publication_id, count(*) as count')
                    ->groupBy('publication_id');
    }

    public function comments_count()
    {
        return $this->hasMany(Comment::class, 'publication_id')
                    ->selectRaw('publication_id, count(*) as count')
                    ->groupBy('publication_id');
    }
}
