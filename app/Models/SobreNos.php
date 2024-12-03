<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SobreNos extends Model
{
    protected $table = 'SobreNos';
    protected $fillable = [
        'tituloEvento',
        'imagemEvento',
        'descricaoEvento',
        'status',
    ];
}
