<?php

namespace App\Filament\Resources\KecResource\Pages;

use App\Filament\Resources\KecResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKecs extends ListRecords
{
    protected static string $resource = KecResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
