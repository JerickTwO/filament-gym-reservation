<?php

namespace App\Filament\Resources\PlanesResource\Pages;

use App\Filament\Resources\PlanesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlanes extends ListRecords
{
    protected static string $resource = PlanesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
