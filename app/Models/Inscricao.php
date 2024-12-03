<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricoes';
    protected $fillable = ['user_id', 'evento_id'];

    // Relação com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação com o evento
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }


}
