<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DetailLevelingIndexResource\Pages;
use App\Models\DetailLevelingIndex;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DetailLevelingIndexResource extends Resource
{
    protected static ?string $model = DetailLevelingIndex::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Detail Leveling Index';

    protected static ?int $navigationSort = -2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Instrumen Pemantauan dan Evaluasi SPBE')
                    ->schema([
                        Forms\Components\Select::make('indicator_id')
                            ->label('Indicator')
                            ->relationship('indicator', 'name')
                            ->required()
                            ->live()
                            ->reactive()
                            ->preload()
                            ->afterStateUpdated(function (Set $set) {
                                $set('leveling_index_id', null);
                            }),

                        Forms\Components\Select::make('leveling_index_id')
                            ->label('Leveling Index')
                            ->options(function (Get $get) {
                                $indicatorId = $get('indicator_id');
                                if ($indicatorId) {
                                    return \App\Models\LevelingIndex::where('indicator_id', $indicatorId)
                                        ->pluck('name', 'id');
                                }

                                return [];
                            })
                            ->live()
                            ->reactive()
                            ->required(),

                        Forms\Components\Textarea::make('detail')
                            ->required()
                            ->columnSpanFull()
                            ->rows(5),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->rows(5),
                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('indicator.name')
                    ->label('Indicator')
                    ->wrap(),
                Tables\Columns\TextColumn::make('levelingIndices.name')
                    ->label('Leveling Index')
                    ->wrap(),
                Tables\Columns\TextColumn::make('detail')
                    ->label('Detail')
                    ->wrap(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->wrap(),
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
            'index' => Pages\ListDetailLevelingIndices::route('/'),
            'create' => Pages\CreateDetailLevelingIndex::route('/create'),
            'edit' => Pages\EditDetailLevelingIndex::route('/{record}/edit'),
        ];
    }
}
