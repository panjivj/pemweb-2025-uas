<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Menu;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make('Input Order')
                    ->description('Silahkan pilih menu dibawah ini')
                    ->collapsible()
                    ->persistCollapsed()
                    ->schema([
                        Forms\Components\TextInput::make('nodoc')
                            ->label('No. Document')
                            ->default(function () {
                                $latestItem = Order::latest('id')->first();
                                $nextNumber = $latestItem ? $latestItem->id + 1 : 1;
                                return 'ORDER-NO' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
                            })
                            ->disabled(),
                        Forms\Components\Hidden::make('nodoc')
                            ->default(function () {
                                $latestItem = Order::latest('id')->first();
                                $nextNumber = $latestItem ? $latestItem->id + 1 : 1;
                                return 'ORDER-NO' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
                            }),
                        Forms\Components\Select::make('kategori_id')
                            ->relationship('kategori', 'name')
                            ->required()
                            ->live()
                            ->reactive()
                            ->afterStateUpdated(function (Set $set) {
                                $set('menu_id', null);
                            }),

                        Forms\Components\Select::make('menu_id')
                            ->label('Menu')
                            ->options(function (Get $get): Collection {

                                $kategoriId = $get('kategori_id');
                                return Menu::query()
                                    ->where('kategori_id', $kategoriId)
                                    ->where('is_available', true)
                                    ->pluck('name', 'id');
                            })
                            ->live()
                            ->preload()
                            ->reactive()
                            ->required()
                            ->afterStateUpdated(function (callable $set, $state, $get) {

                                $menu = Menu::find($state);
                                if ($menu) {
                                    $set('price', $menu->price);

                                    $jumlah = $get('jumlah') ?? 1;
                                    $set('totalprice', $menu->price * (int) $jumlah);
                                }
                            }),

                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->default(0)
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled(),

                        Forms\Components\TextInput::make('jumlah')
                            ->required()
                            ->numeric()
                            ->autocomplete(false)
                            ->maxLength(255)
                            ->afterStateUpdated(function (callable $set, $state, $get) {

                                $price = $get('price') ?? 0;
                                $totalPrice = $price * (int) $state;

                                $set('totalprice', $totalPrice);
                            })
                            ->reactive(),
                        Forms\Components\TextInput::make('totalprice')
                            ->label('Total Price')
                            ->required()
                            ->default(0)
                            ->reactive()
                            ->prefix('Rp')
                            ->numeric()
                            ->disabled(),
                    ])->columns(3),
                Forms\Components\Section::make('Customer')
                    ->schema([
                        Forms\Components\Select::make('detail_user_id')
                            ->label('Pengorder')
                            ->relationship('detailUser', 'username')
                            ->required(),
                    ]),

                Forms\Components\Card::make('Status Pesanan')
                    ->description('Diisi oleh pegawai')
                    ->collapsed()
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'DIPROSES' => 'DIPROSES',
                                'SELESAI' => 'SELESAI',
                            ])
                            ->required()
                    ])


            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nodoc')
                    ->label('No. Doc')
                    ->wrap()
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.name')
                    ->wrap()
                    ->sortable(),
                Tables\Columns\TextColumn::make('menu.name')
                    ->label('Nama Menu')
                    ->wrap()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable()
                    ->numeric()
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('totalprice')
                    ->label('Total Price')
                    ->money('IDR')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('detailUser.username')
                    ->label('Pengorder')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->wrap()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'DIPROSES' => 'gray',
                        'SELESAI' => 'success',
                    }),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
