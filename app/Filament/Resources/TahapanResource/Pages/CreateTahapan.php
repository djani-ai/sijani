<?php

namespace App\Filament\Resources\TahapanResource\Pages;

use App\Filament\Resources\TahapanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTahapan extends CreateRecord
{
    protected static string $resource = TahapanResource::class;
    protected function getRedirectUrl(): string
    {
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
