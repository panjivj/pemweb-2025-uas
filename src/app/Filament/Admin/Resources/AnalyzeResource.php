<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AnalyzeResource\Pages;
use App\Models\Analyze;
use App\Models\DetailLevelingIndex;
use App\Models\Recomendation;
use App\Models\Subject;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AnalyzeResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Analyze::class;

    protected static ?string $navigationLabel = 'Analyze';

    protected static ?string $navigationIcon = 'heroicon-o-square-2-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pilih Kota / Kabupaten')
                    ->schema([
                        Forms\Components\Select::make('subject_id')
                            ->label('Subject')
                            ->columnSpan('full')
                            ->required()
                            ->preload()
                            ->live()
                            ->options(function () {
                                $user = Auth::user();

                                if ($user->name === 'panjijayasutra') {
                                    return Subject::pluck('name', 'id');
                                } elseif ($user->name === 'Subject') {
                                    return Subject::where('user_id', $user->id)->pluck('name', 'id');
                                } elseif ($user->name === 'Assessor') {
                                    return Subject::where('user_id', $user->id)->pluck('name', 'id');
                                } else {
                                    return collect();
                                }
                            })
                            ->reactive(),
                    ]),
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
                                $set('detail_leveling_index_id', null);
                                $set('recomendation_id', null);
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
                            ->required()
                            ->afterStateUpdated(function (Set $set) {
                                $set('detail_leveling_index_id', null);
                                $set('recomendation_id', null);
                            }),

                        Forms\Components\Select::make('detail_leveling_index_id')
                            ->label('Detail Leveling Index')
                            ->columnSpan('full')
                            ->required()
                            ->reactive()
                            ->live()
                            ->options(function (Get $get): Collection {
                                return DetailLevelingIndex::query()
                                    ->where('indicator_id', $get('indicator_id'))
                                    ->where('leveling_index_id', $get('leveling_index_id'))
                                    ->pluck('detail', 'id');
                            })
                            ->afterStateUpdated(fn(Set $set) => $set('recomendation_id', null)),

                        Forms\Components\Select::make('recomendation_id')
                            ->label('Recomendation')
                            ->columnSpan('full')
                            ->reactive()
                            ->live()
                            ->options(function (Get $get): Collection {
                                return Recomendation::query()
                                    ->where('indicator_id', $get('indicator_id'))
                                    ->where('leveling_index_id', $get('leveling_index_id'))
                                    ->where('detail_leveling_index_id', $get('detail_leveling_index_id'))
                                    ->pluck('recommend', 'id');
                            })
                            ->disabled(function () {
                                $user = Auth::user();

                                return $user->name === 'Subject';
                            }),
                    ])->columns(2),

                Forms\Components\Textarea::make('note')
                    ->label('Note')
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Lokus')
                    ->wrap(),
                Tables\Columns\TextColumn::make('indicator.name')
                    ->label('Indikator')
                    ->wrap(),
                Tables\Columns\TextColumn::make('levelingIndices.name')
                    ->label('Level')
                    ->wrap(),
                Tables\Columns\TextColumn::make('detailLevelingIndices.detail')
                    ->label('Detail Leveling Index')
                    ->wrap(),
                Tables\Columns\TextColumn::make('recomendation.recommend')
                    ->label('Rekomendasi')
                    ->wrap(),
                Tables\Columns\TextColumn::make('note')
                    ->searchable()
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
            'index' => Pages\ListAnalyzes::route('/'),
            'create' => Pages\CreateAnalyze::route('/create'),
            'edit' => Pages\EditAnalyze::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }
}
