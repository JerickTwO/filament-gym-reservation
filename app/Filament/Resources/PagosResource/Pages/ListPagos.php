<?php

namespace App\Filament\Resources\PagosResource\Pages;

use App\Filament\Resources\PagosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPagos extends ListRecords
{
    protected static string $resource = PagosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
