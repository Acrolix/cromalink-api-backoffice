<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Nombre de la Tabla:	resources
// Entidad:	Resource
// Objetivo:	Almacenar información de los recursos multimedia (fotos, videos, audios, etc.) asociados a las publicaciones.


// Metadatos:										Descripción del contenido
// Nombre atributo	Tipo dato	Largo	PK	UK	Null	Valor default	Reglas (check)	Foreign Key

// 								hacia tabla	hacia atributo
// id	Numerico		X			AUTO_INCREMENT				Identificador único del recurso.
// publication_id	Numerico							publications	id	Identificador de la publicación a la que pertenece el recurso.
// type	Caracteres	8					('image', 'video', 'audio', 'externo')			Tipo de recurso.
// url	Caracteres	50								URL del recurso (foto, video, etc.).


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

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }
}
