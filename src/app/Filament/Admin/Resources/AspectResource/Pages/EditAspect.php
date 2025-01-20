<?php

namespace App\Filament\Admin\Resources\AspectResource\Pages;

use App\Filament\Admin\Resources\AspectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAspect extends EditRecord
{
    protected static string $resource = AspectResource::class;

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
