<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Nombre de la Tabla:	social_events
// Entidad:	SocialEvent
// Objetivo:	Almacenar información de eventos sociales asociados a publicaciones.


// Metadatos:										Descripción del contenido
// Nombre atributo	Tipo dato	Largo	PK	UK	Null	Valor default	Reglas (check)	Foreign Key

// 								hacia tabla	hacia atributo
// name	Caracteres	20								Nombre del evento social.
// publication_id	Numerico		X					publications	id	Identificador de la publicación asociada al evento social.
// starts_at	Fecha									Fecha y hora de inicio del evento.
// ends_at	Fecha				X					Fecha y hora de fin del evento.
// description	Texto				X					Descripción básica del evento
// country_code	Caracteres	4						country	code	País donde se celebra el evento.
// longitude	Numerico	9,6			X					Longitud geográfica del lugar del evento.
// latitude	Numerico	8,6			X					Latitud geográfica del lugar del evento.


class SocialEvent extends Model
{
    use HasFactory;

    protected $table = 'social_events';
    protected $timestamps = false;

    protected $fillable = [
        'name',
        'publication_id',
        'starts_at',
        'ends_at',
        'description',
        'country_code',
        'longitude',
        'latitude',
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code');
    }

    public function resources()
    {
        return $this->hasMany(Resource::class, 'publication_id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'publication_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'publication_id');
    }
}
