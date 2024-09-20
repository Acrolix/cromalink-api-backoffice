<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $table = 'reactions';
    public $timestamps = false;

    protected $fillable = [
        'publication_id',
        'reaction_by',
        'type',
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

    public function user()
    {
        return $this->belongsTo(UserProfile::class, 'reaction_by', 'user_id');
    }
}
