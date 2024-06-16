<?php

namespace App\Filament\Resources\LhpResource\Pages;

use App\Filament\Resources\LhpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Imports\LhpImporter;
use Filament\Actions\ImportAction;

class ListLhps extends ListRecords
{
    protected static string $resource = LhpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-document')
                ->label('New'),
            ImportAction::make('importProducts')
                ->icon('heroicon-o-document')
                ->label('Import')
                ->importer(LhpImporter::class),
        ];

    }
}
