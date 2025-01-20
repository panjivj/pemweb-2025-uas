<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailUserResource\Pages;
use App\Filament\Resources\DetailUserResource\RelationManagers;
use App\Models\DetailUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailUserResource extends Resource
{
    protected static ?string $model = DetailUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Detail User';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make('Detail User')
                    ->description('Masukkan detail user')
                    ->collapsible()
                    ->persistCollapsed()
                    ->schema([
                        Forms\Components\TextInput::make('username')
                    ->required()
                    ->autocomplete(false)
                    ->regex('/^[A-Z][a-z]*$/')
                    ->maxLength(255),
                Forms\Components\Select::make('bank')
                    ->label('Bank')
                    ->required()
                    ->options([
                        'Mandiri' => 'Mandiri',
                        'BCA' => 'BCA',
                        'Ganesha' => 'Ganesha',
                        'BNI' => 'BNI',
                    ]),
                Forms\Components\TextInput::make('norek')
                    ->label('No Rekening')
                    ->required()
                    ->maxLength(255)
                    ])->columns(3)
                
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank')
                    ->searchable(),
                Tables\Columns\TextColumn::make('norek')
                    ->searchable(),
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
            'index' => Pages\ListDetailUsers::route('/'),
            'create' => Pages\CreateDetailUser::route('/create'),
            'edit' => Pages\EditDetailUser::route('/{record}/edit'),
        ];
    }
}
