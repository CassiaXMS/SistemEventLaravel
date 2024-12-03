<?php

namespace App\Filament\Resources\PerguntasFrequentesResource\Pages;

use App\Filament\Resources\PerguntasFrequentesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPerguntasFrequentes extends ListRecords
{
    protected static string $resource = PerguntasFrequentesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
