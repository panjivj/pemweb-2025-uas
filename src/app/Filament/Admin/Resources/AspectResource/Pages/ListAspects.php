<?php

namespace App\Filament\Admin\Resources\AspectResource\Pages;

use App\Filament\Admin\Resources\AspectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListAspects extends ListRecords
{
    protected static string $resource = AspectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Aspect';
    }
}
