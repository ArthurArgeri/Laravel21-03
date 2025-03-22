<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class criptomoedas extends Model
{
    protected $fillable = [
        'sigla',
        'nome',
        'valor',
    ];
}
