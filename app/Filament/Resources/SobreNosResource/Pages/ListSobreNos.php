<?php

namespace App\Filament\Resources\SobreNosResource\Pages;

use App\Filament\Resources\SobreNosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSobreNos extends ListRecords
{
    protected static string $resource = SobreNosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
