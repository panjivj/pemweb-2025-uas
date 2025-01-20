<?php

namespace App\Filament\Resources\DetailUserResource\Pages;

use App\Filament\Resources\DetailUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListDetailUsers extends ListRecords
{
    protected static string $resource = DetailUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Detail User';
    }
}
