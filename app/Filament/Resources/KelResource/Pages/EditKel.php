<?php

namespace App\Filament\Resources\KelResource\Pages;

use App\Filament\Resources\KelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKel extends EditRecord
{
    protected static string $resource = KelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
