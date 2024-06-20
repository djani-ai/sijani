<?php

namespace App\Filament\Resources\LhpResource\Pages;

use App\Filament\Resources\LhpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Imports\LhpImporter;
use App\Models\Lhp;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\ImportAction;
use Filament\Notifications\Notification;
use PhpOffice\PhpWord\TemplateProcessor;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListLhps extends ListRecords
{
    protected static string $resource = LhpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-document')
                ->label('New'),
            ImportAction::make('importProducts')
                ->icon('heroicon-o-document')
                ->label('Import')
                ->importer(LhpImporter::class),
            ExportAction::make()
                ->exports([
                    ExcelExport::make('table')->fromTable(),
                    ExcelExport::make('form')->fromForm(),
                    ExcelExport::make('Model')->fromModel()
                ]),
        ];
    }
}
