<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventoResource\Pages;
use App\Filament\Resources\EventoResource\RelationManagers;
use App\Models\Evento;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Components\Concerns\HasHelperText;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Placeholder;


class EventoResource extends Resource
{
    protected static ?string $model = Evento::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Grupo da Informações básicas do evento (l.esq)
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informe sobre o evento')
                            ->description('')
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        TextInput::make('titulo')
                                            ->label('Título do Evento')
                                            ->required()
                                            ->placeholder('Digite o título do evento')
                                            ->columnSpan(3),

                                        Select::make('tipo')
                                            ->label('Tipo')
                                            ->options([
                                                'palestra' => 'Palestra',
                                                'workshop' => 'Workshop',
                                                'curso' => 'Curso',
                                                'bate_papo' => 'Bate-papo',
                                                'debate' => 'Debate',
                                            ])
                                            ->required()
                                            ->placeholder('Selecione')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(4),

                                Select::make('categoria_id')
                                    ->label('Categoria')
                                    ->options(Categoria::all()->pluck('nome', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->placeholder('Pesquise uma categoria')
                                    ->columnSpan(1),

                                Forms\Components\Group::make()
                                    ->schema([
                                        Select::make('modalidade')
                                            ->label('Modalidade')
                                            ->options([
                                                'online' => 'Online',
                                                'presencial' => 'Presencial',
                                                'hibrido' => 'Híbrido',
                                            ])
                                            ->required()
                                            ->placeholder('Selecione')
                                            ->columnSpan(1),

                                        Select::make('capacidade')
                                            ->label('Capacidade')
                                            ->options([
                                                'ate_30' => 'Até 30 pessoas',
                                                'ate_50' => 'Até 50 pessoas',
                                                'ate_100' => 'Até 100 pessoas',
                                                'ate_200' => 'Até 200 pessoas',
                                            ])
                                            ->required()
                                            ->placeholder('Selecione')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2), // Colocando os campos lado a lado
                            ])
                            ->columnSpan('full')
                            ->collapsible(),
                    ])
                    ->columnSpan('full'),



                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Descrição do Evento')
                            ->schema([
                                Forms\Components\MarkdownEditor::make('description')
                                    ->label('Escreva uma descrição do evento')
                                    ->required()
                                    ->columnSpan(2),
                            ])->columns(2)

                    ]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Data e Hora')
                            ->schema([
                                DateTimePicker::make('data_comecar_evento')
                                    ->label('Quando o evento começa')
                                    ->minDate(now())
                                    ->reactive()
                                    ->rule('after_or_equal:today')
                                    ->required(),

                                DateTimePicker::make('data_terminar_evento')
                                    ->label('Quando o evento termina')
                                    ->minDate(now())
                                    ->rule('after_or_equal:start_date') // Valida que a data final seja igual ou após a data de início
                                    ->reactive() // Atualiza dinamicamente
                                    ->required(),


                                TextInput::make('endereco')
                                    ->label('Local')
                                    ->required()
                                    ->placeholder('Ex.: FATEC Campinas')
                                    ->columnSpan('full'),

                                TextInput::make('sala')
                                    ->label('Sala')
                                    ->placeholder('Informe a sala')
                                    ->columnSpan('full'),

                            ])->columns(2),


                    ]),



                // Outros formulários (exemplo: Convidado, Descrição, Divulgação, etc.)
                Forms\Components\Section::make('Convidado')
                    ->schema([
                        Forms\Components\Group::make()
                            ->schema([
                                TextInput::make('nome_convidado')
                                    ->label('Nome do convidado')
                                    ->required()
                                    ->placeholder('Digite o nome do convidado')
                                    ->columnSpan(2),

                                TextInput::make('especialidade')
                                    ->label('Especialidade/área')
                                    ->required()
                                    ->placeholder('Digite qual a especialidade')
                                    ->columnSpan(1),


                                Forms\Components\MarkdownEditor::make('biografia')
                                    ->label('Escreva a biografia do convidado')
                                    ->columnSpan(2),


                                Forms\Components\FileUpload::make('perfil_image')
                                    ->label('Imagem de Perfil')
                                    ->required()
                                    ->columnSpan(1)

                            ])->columns(3),

                        Toggle::make('publicado')
                            ->label('Publicar evento')
                            ->helperText("Ative ou desative a visibilidade do Evento")
                            ->default(false),

                    ])->collapsible(),
            ]);



    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titulo')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                Tables\Columns\IconColumn::make('publicado')
                    ->label('Status')
                    ->sortable()
                    ->toggleable()
                    ->boolean(),
                Tables\Columns\ImageColumn::make('perfil_image')
                    ->label('Imagem'),


                Tables\Columns\TextColumn::make('nome_convidado'),
                Tables\Columns\TextColumn::make('nome_convidado'),
                Tables\Columns\TextColumn::make('sala'),
                Tables\Columns\TextColumn::make('data_comecar_evento')
                    ->label('Data')

                    ->dateTime()
                    ->sortable()



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
            'index' => Pages\ListEventos::route('/'),
            'create' => Pages\CreateEvento::route('/create'),
            'edit' => Pages\EditEvento::route('/{record}/edit'),
        ];
    }
}
