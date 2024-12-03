<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SobreNosResource\Pages;
use App\Filament\Resources\SobreNosResource\RelationManagers;
use App\Models\SobreNos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\RichEditor;

class SobreNosResource extends Resource
{
    protected static ?string $model = SobreNos::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = 'Editar página';
    public static function getLabel(): string
    {
        return 'Sobre nós'; // Nome singular no painel
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([

                        TextInput::make('tituloEvento')
                            ->label('Qual é a atividade acadêmica')
                            ->placeholder('Ex.: Semana de Tecnologia ')
                            ->required()
                            ->columnSpan(2),


                        RichEditor::make('descricaoEvento')
                            ->label('Descreva sobre essa atividade')
                            ->placeholder('Digite a descrição do evento')
                            ->required()
                            ->toolbarButtons([
                                'heading', // Para títulos
                                'bold', // Negrito
                                'italic', // Itálico
                                'bulletList', // Lista com pontos
                                'orderedList', // Lista numerada
                                'link', // Inserir links
                                'codeBlock', // Código
                                'blockquote', // Citação
                            ]),

                        Forms\Components\FileUpload::make('imagemEvento')
                            ->label('Insira uma imagem representativa')
                            ->required(),
                        Toggle::make('status')
                            ->label('Publicar Sobre nos')
                            ->helperText("Ative ou desative a visibilidade.")
                            ->default(false)


                    ]),



            ]);
    }
    public static function canCreate(): bool
    {
        // Bloqueia a criação se já existir um registro
        return !SobreNos::exists();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('tituloEvento')->label('Título'),
                Tables\Columns\TextColumn::make('created_at')->label('Criado em')->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]) // Desativar ações em massa
            ->headerActions([
                // Verifica se existe um registro para ocultar o botão "Criar"
                Tables\Actions\CreateAction::make()
                    ->hidden(SobreNos::exists()),
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
            'index' => Pages\ListSobreNos::route('/'),
            'create' => Pages\CreateSobreNos::route('/create'),
            'edit' => Pages\EditSobreNos::route('/{record}/edit'),
        ];
    }
}
