<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table = 'anuncios';

    protected $fillable = [
        'id_customer',
        'id_meta',
        'id_google',
        'insights',
    ];

    protected $casts = [
        'insights' => 'array',
    ];
}
