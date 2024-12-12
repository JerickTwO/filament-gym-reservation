<?php

namespace App\Filament\Resources\ControlAccesoResource\Pages;

use App\Filament\Resources\ControlAccesoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListControlAccesos extends ListRecords
{
    protected static string $resource = ControlAccesoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
