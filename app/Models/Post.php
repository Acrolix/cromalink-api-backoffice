<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // CREATE TABLE publications (
    //     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     title VARCHAR(20) NOT NULL,
    //     content TEXT,
    //     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    //     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    //     published_by INT UNSIGNED NOT NULL,
    //     FOREIGN KEY (published_by) REFERENCES users(id),
    //     CONSTRAINT chk_publications_created_at CHECK (created_at <= SYSDATE()),
    //     CONSTRAINT chk_publications_updated_at CHECK (updated_at <= SYSDATE() AND updated_at >= created_at)
    // );

    protected $table = 'publications';

    protected $fillable = [
        'id',
        'title',
        'content',
        'published_by',
    ];

    public function user()
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
