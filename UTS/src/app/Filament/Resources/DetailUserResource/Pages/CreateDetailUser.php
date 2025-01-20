<?php

namespace App\Filament\Resources\DetailUserResource\Pages;

use App\Filament\Resources\DetailUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDetailUser extends CreateRecord
{
    protected static string $resource = DetailUserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
