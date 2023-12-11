<?php

namespace App\Filament\Resources\KelResource\Pages;

use App\Filament\Resources\KelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKel extends CreateRecord
{
    protected static string $resource = KelResource::class;
    protected function getRedirectUrl(): string
    {
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
