<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscripcionesResource\Pages;
use App\Filament\Resources\InscripcionesResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Inscripciones;
use Closure;
use Carbon\Carbon;

class InscripcionesResource extends Resource
{
    protected static ?string $model = Inscripciones::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Inscripciones';
    protected static ?string $modelLabel = 'Inscripción';
    protected static ?string $pluralModelLabel = 'Inscripciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('cliente_id')
                    ->relationship('cliente', 'nombre')
                    ->searchable()
                    ->required()
                    ->label('Cliente'),

                Forms\Components\Select::make('status')
                    ->options([
                        'ACTIVO' => 'Activo',
                        'VENCIDO' => 'Vencido',
                        'SUSPENDIDO' => 'Suspendido'
                    ])
                    ->default('ACTIVO')
                    ->required(),

                Forms\Components\TextInput::make('monto_pagado')
                    ->label('Monto Pagado')
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\Select::make('planes_id')
                    ->relationship('planes', 'nombre')
                    ->searchable()
                    ->required()
                    ->label('Plan')
                    ->reactive() // Asegura que el campo es reactivo
                    ->afterStateUpdated(function (Closure $set, $state, $livewire) {
                        // Obtén el plan seleccionado y actualiza la fecha de fin
                        $plan = \App\Models\Planes::find($state);
                        if ($plan) {
                            $duracionDias = $plan->duracion_dias;
                            $fechaInicio = $livewire->form->getState('fecha_inicio');
                            if ($fechaInicio) {
                                $fechaFin = \Carbon\Carbon::parse($fechaInicio)->addDays($duracionDias)->format('Y-m-d');
                                $set('fecha_fin', $fechaFin);
                            }
                        }
                    }),

                Forms\Components\DatePicker::make('fecha_inicio')
                    ->label('Fecha de Inicio')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($set, $state, $livewire) {
                        $planId = $livewire->form->getState('planes_id');
                        if ($planId) {
                            $plan = \App\Models\Planes::find($planId);
                            if ($plan && $state) {
                                $duracionDias = $plan->duracion_dias;
                                $fechaFin = \Carbon\Carbon::parse($state)->addDays($duracionDias)->format('Y-m-d');
                                $set('fecha_fin', $fechaFin);
                            }
                        }
                    }),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.nombre')
                    ->label('Cliente')
                    ->searchable(),

                Tables\Columns\TextColumn::make('planes.nombre')
                    ->label('Plan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->label('Fecha de Inicio')
                    ->date(),

                Tables\Columns\TextColumn::make('fecha_fin')
                    ->label('Fecha de Fin')
                    ->date(),

                Tables\Columns\BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'success' => 'ACTIVO',
                        'danger' => 'VENCIDO',
                        'warning' => 'SUSPENDIDO'
                    ])
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado')
                    ->options([
                        'ACTIVO' => 'Activo',
                        'VENCIDO' => 'Vencido',
                        'SUSPENDIDO' => 'Suspendido'
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInscripciones::route('/'),
            'create' => Pages\CreateInscripciones::route('/create'),
            'edit' => Pages\EditInscripciones::route('/{record}/edit'),
        ];
    }
}
