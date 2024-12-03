<?php

namespace App\Filament\Resources\InscritosResource\Pages;

use App\Filament\Resources\InscritosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInscritos extends EditRecord
{
    protected static string $resource = InscritosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
