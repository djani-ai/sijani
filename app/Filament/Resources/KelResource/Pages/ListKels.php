<?php

namespace App\Filament\Resources\KelResource\Pages;

use App\Filament\Resources\KelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKels extends ListRecords
{
    protected static string $resource = KelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
