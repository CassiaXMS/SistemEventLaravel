<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasFrequentes extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'status',
    ];
}
