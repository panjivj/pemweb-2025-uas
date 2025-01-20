<?php

namespace App\Filament\Admin\Resources\RecomendationResource\Pages;

use App\Filament\Admin\Resources\RecomendationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListRecomendations extends ListRecords
{
    protected static string $resource = RecomendationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Recomendation';
    }
}
