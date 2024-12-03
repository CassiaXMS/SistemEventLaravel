<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscritosResource\Pages;
use App\Filament\Resources\InscritosResource\RelationManagers;
use App\Models\Inscricao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\Evento;
use App\Models\User;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InscritosResource extends Resource
{
    protected static ?string $model = Inscricao::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    public static function getLabel(): string
    {
        return 'Inscritos'; // Nome singular no painel
    }
    public static function getPluralLabel(): string
    {
        return 'Inscritos'; // Nome plural no painel
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Usuário')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('evento_id')
                    ->label('Evento')
                    ->options(Evento::all()->pluck('titulo', 'id'))
                    ->searchable()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('user.profile_photo')
                    ->label('Foto'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nome do Usuário')
                ->searchable(),
                Tables\Columns\TextColumn::make('user.email') // Adiciona o e-mail do usuário
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.identificacao') // Adiciona o e-mail do usuário
                    ->label('Identificação')
                    ->searchable(),
                Tables\Columns\TextColumn::make('evento.titulo')
                    ->label('Evento')
                ->searchable(),
                Tables\Columns\TextColumn::make('user.curso') // Adiciona o e-mail do usuário
                    ->label('Curso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data de Inscrição')
                    ->dateTime('d/m/Y H:i'),



            ])
            ->filters([
                // SelectFilter::make('evento_id')
                // ->label('Filtrar por Evento')
                // ->options(Evento::all()->pluck('titulo', 'id')),
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
            'index' => Pages\ListInscritos::route('/'),
            'create' => Pages\CreateInscritos::route('/create'),
            'edit' => Pages\EditInscritos::route('/{record}/edit'),
        ];
    }
}
