<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
        protected $fillable = [
        'Titulo',
        'description',
        'Duracion',
        'Id_genero',
    ];

    public function genero() {

        return $this->belongsTo(Genero::class);
    }
}
