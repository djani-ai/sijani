<?php

namespace App\Filament\Resources\TahapanResource\Pages;

use App\Filament\Resources\TahapanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTahapan extends EditRecord
{
    protected static string $resource = TahapanResource::class;

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
