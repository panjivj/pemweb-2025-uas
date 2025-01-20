<?php

namespace App\Filament\Resources\DetailUserResource\Pages;

use App\Filament\Resources\DetailUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailUser extends EditRecord
{
    protected static string $resource = DetailUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
