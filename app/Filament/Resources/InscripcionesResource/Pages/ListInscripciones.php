<?php

namespace App\Filament\Resources\InscripcionesResource\Pages;

use App\Filament\Resources\InscripcionesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInscripciones extends ListRecords
{
    protected static string $resource = InscripcionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
