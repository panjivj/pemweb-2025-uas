<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LevelingIndexResource\Pages;
use App\Models\LevelingIndex;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LevelingIndexResource extends Resource
{
    protected static ?string $model = LevelingIndex::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Leveling Index';

    protected static ?int $navigationSort = -3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make('Input Leveling')
                    ->schema([
                        Forms\Components\Select::make('indicator_id')
                            ->label('Indikator')
                            ->required()
                            ->relationship('indicator', 'name'),
                        Forms\Components\TextInput::make('name')
                            ->label('Leveling Index')
                            ->required()
                            ->autocomplete(false),
                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('indicator.name')->label('Indicator')->wrap(),
                Tables\Columns\TextColumn::make('name')->searchable()->wrap(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLevelingIndices::route('/'),
            'create' => Pages\CreateLevelingIndex::route('/create'),
            'edit' => Pages\EditLevelingIndex::route('/{record}/edit'),
        ];
    }
}
