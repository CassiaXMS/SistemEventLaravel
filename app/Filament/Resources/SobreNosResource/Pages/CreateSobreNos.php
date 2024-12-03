<?php

namespace App\Filament\Resources\SobreNosResource\Pages;

use App\Filament\Resources\SobreNosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;


class CreateSobreNos extends CreateRecord
{
    protected static string $resource = SobreNosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sobre-nós Criado!')
            ->body(' Sobre-nós criado com Sucesso.');
    }
}
