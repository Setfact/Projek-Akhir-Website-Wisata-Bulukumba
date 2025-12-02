<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

// --- PERUBAHAN BESAR DI SINI ---
// Kita ganti alamatnya ke Filament\Actions (Bukan Tables\Actions)
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn; 
use BackedEnum; 
// -------------------------------

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Pesanan Masuk';
    
    protected static ?string $pluralModelLabel = 'Daftar Pesanan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // -- Info Pesanan --
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Nama Pemesan')
                    ->disabled(), 

                Forms\Components\Select::make('destination_id')
                    ->relationship('destination', 'name')
                    ->label('Destinasi Wisata')
                    ->disabled(),

                Forms\Components\TextInput::make('quantity')
                    ->label('Jumlah Orang')
                    ->numeric()
                    ->disabled(),
                
                Forms\Components\TextInput::make('total_price')
                    ->label('Total Bayar')
                    ->prefix('Rp')
                    ->numeric()
                    ->disabled(),

                // -- Update Status --
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Menunggu Bayar',
                        'paid' => 'Lunas (Paid)',
                        'cancelled' => 'Dibatalkan',
                        'refunded' => 'Dikembalikan (Refund)',
                    ])
                    ->label('Status Pembayaran')
                    ->required()
                    ->native(false),

                Forms\Components\Textarea::make('refund_note')
                    ->label('Catatan (Untuk Refund/Batal)')
                    ->placeholder('Isi alasan jika pesanan dibatalkan...')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable()->searchable(),
                TextColumn::make('user.name')->label('Pemesan')->searchable()->sortable(),
                TextColumn::make('destination.name')->label('Wisata')->searchable(),
                TextColumn::make('total_price')->label('Total')->money('IDR')->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'cancelled' => 'danger',
                        'refunded' => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu Bayar',
                        'paid' => 'Lunas',
                        'cancelled' => 'Batal',
                        'refunded' => 'Refund',
                        default => $state,
                    }),

                TextColumn::make('created_at')->dateTime('d M Y, H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // Kita panggil EditAction dari alamat baru
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                // Kita kosongkan dulu Bulk Actions supaya halaman mau loading
                // Tables\Actions\BulkActionGroup::make([...]), 
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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