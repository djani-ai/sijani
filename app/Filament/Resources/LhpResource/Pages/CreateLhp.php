<?php

namespace App\Filament\Resources\LhpResource\Pages;

use App\Filament\Resources\LhpResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use PhpOffice\PhpWord\TemplateProcessor;

class CreateLhp extends CreateRecord
{
    protected static string $resource = LhpResource::class;
    protected function getRedirectUrl(): string
    {
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
