<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fallows extends Model
{
    use HasFactory;

    protected $table = 'users_followers';
    public $timestamps = false;

    protected $fillable = [
        'follower_id',
        'followed_id',
    ];

    public function follower()
    {
        return $this->belongsTo(UserProfile::class, 'follower_id');
    }

    public function followed()
    {
        return $this->belongsTo(UserProfile::class, 'followed_id');
    }

}
