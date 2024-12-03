<?php

namespace App\Filament\Resources\PerguntasFrequentesResource\Pages;

use App\Filament\Resources\PerguntasFrequentesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePerguntasFrequentes extends CreateRecord
{
    protected static string $resource = PerguntasFrequentesResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Pergunta Criada!')
            ->body(' Pergunta criada com Sucesso.');
    }
}
