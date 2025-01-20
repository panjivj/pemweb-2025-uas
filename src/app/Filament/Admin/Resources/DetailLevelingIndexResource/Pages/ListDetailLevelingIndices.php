<?php

namespace App\Filament\Admin\Resources\DetailLevelingIndexResource\Pages;

use App\Filament\Admin\Resources\DetailLevelingIndexResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListDetailLevelingIndices extends ListRecords
{
    protected static string $resource = DetailLevelingIndexResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Detail Leveling Index';
    }
}
