<?php

namespace App\Filament\Resources\PlanesResource\Pages;

use App\Filament\Resources\PlanesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlanes extends EditRecord
{
    protected static string $resource = PlanesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
