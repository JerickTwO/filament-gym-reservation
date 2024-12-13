<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanesResource\Pages;
use App\Filament\Resources\PlanesResource\RelationManagers;
use App\Models\Planes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanesResource extends Resource
{
    protected static ?string $model = Planes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dias_duracion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio'),
                Tables\Columns\TextColumn::make('descripcion'),
                Tables\Columns\TextColumn::make('activo'),
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
            'index' => Pages\ListPlanes::route('/'),
            'create' => Pages\CreatePlanes::route('/create'),
            'edit' => Pages\EditPlanes::route('/{record}/edit'),
        ];
    }
}
