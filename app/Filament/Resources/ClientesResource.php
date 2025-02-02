<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\ClientesResource\Pages;
use Filament\Tables\Columns\ImageColumn;
use App\Models\Clientes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientesResource extends Resource
{
    protected static ?string $model = Clientes::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Clientes';
    protected static ?string $modelLabel = 'Cliente';
    protected static ?string $pluralModelLabel = 'Clientes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Información Personal')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('apellido')
                            ->label('Apellido')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('correo')
                            ->label('Correo Electrónico')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('celular')
                            ->label('Celular')
                            ->tel()
                            ->maxLength(20),

                        DatePicker::make('fecha_nac')
                            ->label('Fecha de Nacimiento')
                            ->maxDate(now()),

                        Select::make('genero')
                            ->label('Género')
                            ->options([
                                'Masculino' => 'Masculino',
                                'Femenino' => 'Femenino',
                                'Otro' => 'Otro'
                            ]),
                        FileUpload::make('imagen')
                            ->disk('public')
                            ->label('Imagen')
                            ->image()
                            ->directory('uploads/images') // Carpeta donde se guardará
                            ->required() // Si es obligatorio
                            ->maxSize(2048) // Tamaño máximo en KB (2 MB)

                    ]),

                Textarea::make('observacion')
                    ->label('Observaciones')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido')
                    ->searchable(),
                Tables\Columns\TextColumn::make('correo'),
                Tables\Columns\TextColumn::make('celular'),
                Tables\Columns\TextColumn::make('fecha_nac'),
                Tables\Columns\TextColumn::make('genero'),
                Tables\Columns\ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->size(50)

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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateClientes::route('/create'),
            'edit' => Pages\EditClientes::route('/{record}/edit'),
        ];
    }
}
