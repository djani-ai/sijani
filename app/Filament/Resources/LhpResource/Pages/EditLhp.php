<?php

namespace App\Filament\Resources\LhpResource\Pages;

use App\Filament\Resources\LhpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLhp extends EditRecord
{
    protected static string $resource = LhpResource::class;

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
