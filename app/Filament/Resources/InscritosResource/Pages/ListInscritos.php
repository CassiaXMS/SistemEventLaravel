<?php

namespace App\Filament\Resources\InscritosResource\Pages;

use App\Filament\Resources\InscritosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInscritos extends ListRecords
{
    protected static string $resource = InscritosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
