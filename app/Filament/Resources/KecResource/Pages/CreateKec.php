<?php

namespace App\Filament\Resources\KecResource\Pages;

use App\Filament\Resources\KecResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKec extends CreateRecord
{
    protected static string $resource = KecResource::class;
    protected function getRedirectUrl(): string
    {
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
