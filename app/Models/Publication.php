<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $timestamps = true;

    protected $fillable = [
        'id',
        'title',
        'content',
        'published_by',
    ];

    public function published_by()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class, 'publication_id');
    // }

    // public function likes()
    // {
    //     return $this->hasMany(Like::class, 'publication_id');
    // }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class, 'publication_tag', 'publication_id', 'tag_id');
    // }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];




}
