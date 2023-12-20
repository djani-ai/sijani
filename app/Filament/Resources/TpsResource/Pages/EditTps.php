<?php

namespace App\Filament\Resources\TpsResource\Pages;

use App\Filament\Resources\TpsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTps extends EditRecord
{
    protected static string $resource = TpsResource::class;

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
