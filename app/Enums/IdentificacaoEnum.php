<?php

namespace App\Enums;

enum IdentificacaoEnum: string
{
    case Aluno = 'Aluno da FATEC Campinas';
    case Professor = 'Professor da FATEC Campinas';
    case Visitante = 'Visitante';
}
