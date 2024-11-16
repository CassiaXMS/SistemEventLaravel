<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'titulo',
        'tipo',
        'categoria_id',
        'modalidade',
        'capacidade',
        //'inicio_evento',
       // 'fim_evento',
        'publicado',
        //'image',
        'description',
        'endereco',
        'sala',
        'data_comecar_evento',
        'data_terminar_evento',
        'nome_convidado',
        'especialidade',
        'biografia',
        'perfil_image',
        'contato',

    ];

    public function categoria()
{
    return $this->belongsTo(Categoria::class);
}
}
