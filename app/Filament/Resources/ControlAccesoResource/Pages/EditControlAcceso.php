<?php

namespace App\Filament\Resources\ControlAccesoResource\Pages;

use App\Filament\Resources\ControlAccesoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditControlAcceso extends EditRecord
{
    protected static string $resource = ControlAccesoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
