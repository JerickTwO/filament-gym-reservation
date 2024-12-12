<?php

namespace App\Filament\Resources\InscripcionesResource\Pages;

use App\Filament\Resources\InscripcionesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInscripciones extends EditRecord
{
    protected static string $resource = InscripcionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
