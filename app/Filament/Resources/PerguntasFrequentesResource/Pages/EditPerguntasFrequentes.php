<?php

namespace App\Filament\Resources\PerguntasFrequentesResource\Pages;

use App\Filament\Resources\PerguntasFrequentesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditPerguntasFrequentes extends EditRecord
{
    protected static string $resource = PerguntasFrequentesResource::class;

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

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Pergunta Atualizada! ')
            ->body('Pergunta atualizada com sucesso.');
    }
}
