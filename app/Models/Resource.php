<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $table = 'resources';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'publication_id',
        'type',
        'url',
    ];

    protected $hidden = ['publication_id'];

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }
}
