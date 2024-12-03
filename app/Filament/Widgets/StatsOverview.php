<?php

namespace App\Filament\Widgets;

use App\Models\Evento;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        return [
            Stat::make('Total de inscritos', User::count())
            ->description("Usuários inscritos")
            ->descriptionIcon('heroicon-o-user-group')
            ->color('success')
            ->chart([7,3,4,5,6,3,5,3]),

            Stat::make('Total de eventos', Evento::count())
            ->description("Eventos publicados")
            ->descriptionIcon('heroicon-o-calendar-days')
            ->color('danger')
            ->chart([7,3,4,5,6,3,5,3])
        ];
    }
}
