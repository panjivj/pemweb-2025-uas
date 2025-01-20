<?php

namespace App\Filament\Admin\Resources\AnalyzeResource\Pages;

use App\Filament\Admin\Resources\AnalyzeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListAnalyzes extends ListRecords
{
    protected static string $resource = AnalyzeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Analyze';
    }
}
