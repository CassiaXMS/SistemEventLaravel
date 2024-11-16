<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'slug','status'];

    // Relacionamento com a tabela de eventos
    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

}
