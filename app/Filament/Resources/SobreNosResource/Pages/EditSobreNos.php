<?php

namespace App\Filament\Resources\SobreNosResource\Pages;

use App\Filament\Resources\SobreNosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditSobreNos extends EditRecord
{
    protected static string $resource = SobreNosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sobre-nós Atualizado!')
            ->body(' Sobre-nós atualizado com Sucesso.');
    }
}
