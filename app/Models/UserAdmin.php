<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    use HasFactory;

    protected $table = 'user_admin';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'role',
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRole($value)
    {
        return ucfirst($value);
    }

    public function setRole($value)
    {
        return $this->attributes['role'] = strtolower($value);
    }

    public function getFullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
