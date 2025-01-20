<?php

namespace App\Filament\Admin\Resources\IndicatorResource\Pages;

use App\Filament\Admin\Resources\IndicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndicator extends EditRecord
{
    protected static string $resource = IndicatorResource::class;

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
