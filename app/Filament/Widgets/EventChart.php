<?php

namespace App\Filament\Widgets;
use App\Models\Evento;
use Filament\Widgets\ChartWidget;
use App\Models\User;

class EventChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Eventos por Usuários';
    protected  int | string | array $columnSpan = 'full'; // 12 ocupa a largura completa

    protected function getData(): array
    {

        $data = $this->getEventosPorUsuarios(); // Recupera os dados de eventos e usuários
        return [
            'datasets' => [
                [
                    'label' => "Eventos inscrito",
                    'data' => $data['eventosPorUser'], // Dados da contagem de eventos por usuário
                ]
            ],
            'labels' => $data['usuarios'], // Labels com os nomes dos usuários
        ];

    }

    protected function getType(): string
    {
        return 'bar';
    }
    private function getEventosPorUsuarios(): array
    {
        // Recuperando todos os usuários (com relação aos eventos, se necessário)
        $users = User::all();
        $eventosPorUser = [];
        $usuarios = [];

        // Contando os eventos por usuário
        foreach ($users as $user) {
            // Contando os eventos criados por cada usuário
            $count = $user->eventos()->count(); // Usando o relacionamento 'eventos' no modelo User
            $eventosPorUser[] = $count;
            $usuarios[] = $user->name; // Adicionando o nome do usuário
        }

        // Certifique-se de retornar corretamente o array com as chaves 'eventosPorUser' e 'usuarios'
        return [
            'eventosPorUser' => $eventosPorUser, // Contagem dos eventos por usuário
            'usuarios' => $usuarios // Nomes dos usuários
        ];
    }


}
