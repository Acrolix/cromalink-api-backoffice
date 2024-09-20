<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

//     Nombre de la Tabla:	user_profile
// Entidad:	UserProfile
// Objetivo:	Almacenar información adicional del perfil del usuario.


// Metadatos:										Descripción del contenido
// Nombre atributo	Tipo dato	Largo	PK	UK	Null	Valor default	Reglas (check)	Foreign Key

// 								hacia tabla	hacia atributo
// user_id	Numerico		X					users	id	Identificador del usuario.
// username	Caracteres	20		X			^[a-zA-Z0-9_]+$			Nombre ficticio del usuario.
// first_name	Caracteres	30								Primer Nombre real del usuario
// last_name	Caracteres	30								Apellido del usuario.
// biography	Texto				X					Biografía del usuario.
// birth_date	Fecha						menor que la fecha actual menos 18 años			Fecha de nacimiento del usuario (debe ser mayor de 18 años).
// country_code	Caracteres	4						country	code	País de residencia del usuario.
// avatar	Caracteres	50			X					URL de la foto de perfil del usuario.


    use HasFactory;

    protected $table = 'user_profile';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'username',
        'first_name',
        'last_name',
        'biography',
        'birth_date',
        'country_code',
        'avatar',
    ];

    protected $casts = [
        'birth_date' => 'datetime',
    ];

    protected $hidden = ['biography', 'birth_date', 'avatar'];

    public function getFullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAvatar()
    {
        return $this->avatar ? $this->avatar : "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?s=200&d=identicon";
    }

    function getBiography()
    {
        return $this->biography ? $this->biography : "Sin biografía";
    }

    function getBirthDate()
    {
        return $this->birth_date;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }

    public function social_events()
    {
        return $this->hasMany(SocialEvent::class, 'publication_id')->with('participants');
    }

    public function publications()
    {
        return $this->hasMany(Publication::class, 'published_by' , 'user_id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'reaction_by' , 'reaction_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_by', 'published_by');
    }

    public function resources()
    {
        return $this->hasMany(Resource::class, 'resource_by');
    }
}
