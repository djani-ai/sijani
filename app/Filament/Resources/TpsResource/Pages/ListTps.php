<?php

namespace App\Filament\Resources\TpsResource\Pages;

use App\Filament\Resources\TpsResource;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTps extends ListRecords
{
    protected static string $resource = TpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
            ->color("primary"),
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
