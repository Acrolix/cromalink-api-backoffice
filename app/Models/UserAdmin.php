<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    use HasFactory;

    // CREATE TABLE user_admin (
    //     user_id INT UNSIGNED PRIMARY KEY,
    //     first_name VARCHAR(30) NOT NULL,
    //     last_name VARCHAR(30) NOT NULL,
    //     role VARCHAR(10) NOT NULL,
    //     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    //     CONSTRAINT chk_admin_role CHECK (role IN ('Moderador', 'Admin'))
    // );

    protected $table = 'user_admin';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'role',
    ];

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
