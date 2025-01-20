<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RecomendationResource\Pages;
use App\Models\DetailLevelingIndex;
use App\Models\Recomendation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class RecomendationResource extends Resource
{
    protected static ?string $model = Recomendation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Recomendation';

    protected static ?int $navigationSort = 2;

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
                            ->reactive()
                            ->required()
                            ->afterStateUpdated(function (Set $set) {
                                $set('detail_leveling_index_id', null);
                            }),
                        Forms\Components\Select::make('detail_leveling_index_id')
                            ->label('Detail Leveling Index')
                            ->required()
                            ->reactive()
                            ->columnSpanFull()
                            ->options(function (Get $get): Collection {
                                return DetailLevelingIndex::query()
                                    ->where('indicator_id', $get('indicator_id'))
                                    ->where('leveling_index_id', $get('leveling_index_id'))
                                    ->pluck('detail', 'id');
                            })
                            ->afterStateUpdated(fn(Set $set) => $set('recomendation_id', null)),
                    ])->columns(2),

                Forms\Components\Textarea::make('recommend')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('indicator.name')
                    ->label('Indikator')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('levelingIndices.name')
                    ->label('Leveling Index')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('detailLevelingIndices.detail')
                    ->label('Detail Leveling Index')
                    ->wrap(),
                Tables\Columns\TextColumn::make('recommend')
                    ->label('Rekomendasi')
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecomendations::route('/'),
            'create' => Pages\CreateRecomendation::route('/create'),
            'edit' => Pages\EditRecomendation::route('/{record}/edit'),
        ];
    }
}
