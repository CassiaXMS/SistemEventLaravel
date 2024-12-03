<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerguntasFrequentesResource\Pages;
use App\Filament\Resources\PerguntasFrequentesResource\RelationManagers;
use App\Models\PerguntasFrequentes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;

class PerguntasFrequentesResource extends Resource
{
    protected static ?string $model = PerguntasFrequentes::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Editar página';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pergunta Frequente')
                    ->schema([
                        TextInput::make('question')->placeholder('Digite a questão')
                            ->label('Questão')
                            ->required(),
                        RichEditor::make('answer')
                            ->label('Descreva a resposta')
                            ->required()
                            ->columnSpan(2),

                        Toggle::make('status')
                            ->label('Publicar evento')
                            ->helperText("Ative ou desative a visibilidade do Evento")
                            ->default(false)

                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPerguntasFrequentes::route('/'),
            'create' => Pages\CreatePerguntasFrequentes::route('/create'),
            'edit' => Pages\EditPerguntasFrequentes::route('/{record}/edit'),
        ];
    }
}
