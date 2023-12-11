<?php

namespace App\Filament\Resources\LhpResource\Pages;

use App\Filament\Resources\LhpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLhps extends ListRecords
{
    protected static string $resource = LhpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
