<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publications';

    protected $fillable = [
        'title',
        'content',
        'created_at',
        'created_by',
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by')
                    ->select(['id', 'first_name', 'last_name', 'username', 'picture', 'country']);
    }

    public function reactions()
    {
        return $this->hasMany(Reaccion::class, 'publication_id');
    }

    public function casts()
    {
        return [
            'created_at' => 'datetime',
        ];
    }
}