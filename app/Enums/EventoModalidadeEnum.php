<?php

namespace App\Enums;

enum EventoModalidadeEnum : string {

    case PRESENCIAL = 'presencial';
    case ONLINE = 'online';
    case HIBRIDO = 'hibrido';
}