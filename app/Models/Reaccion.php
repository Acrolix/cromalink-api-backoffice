<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaccion extends Model
{
    use HasFactory;

    protected $table = 'reactions';

    protected $fillable = [
        'publication_id',
        'reaction_by',
    ];

    public function publication()
    {
        return $this->belongsTo(Publicacion::class, 'publication_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'reaction_by');
    }
}
