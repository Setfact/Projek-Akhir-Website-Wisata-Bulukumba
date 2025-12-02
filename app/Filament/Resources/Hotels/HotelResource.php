<?php

// NAMESPACE DISESUAIKAN DENGAN FOLDER "Hotels"
namespace App\Filament\Resources\Hotels;

use App\Filament\Resources\Hotels\Pages; // Sesuaikan import Pages
use App\Models\Hotel;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

// IMPORT MANUAL AGAR AMAN
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Illuminate\Support\Str;
use BackedEnum; // <--- WAJIB IMPORT INI

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    // PERBAIKAN DI SINI: Tipe data harus lengkap (string|BackedEnum|null)
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office';
    
    protected static ?string $navigationLabel = 'Data Penginapan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Hotel/Penginapan')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\FileUpload::make('image_url')
                    ->label('Foto Hotel')
                    ->image()
                    ->directory('hotels'),

                Forms\Components\TextInput::make('location')
                    ->label('Lokasi')
                    ->required(),

                Forms\Components\TextInput::make('price_per_night')
                    ->label('Harga per Malam')
                    ->prefix('Rp')
                    ->numeric()
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Fasilitas / Deskripsi')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')->label('Foto'),
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('location')->label('Lokasi')->searchable(),
                TextColumn::make('price_per_night')->label('Harga/Malam')->money('IDR')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Menggunakan Actions dari Filament\Actions (sesuai V4)
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                // BulkActionGroup::make([ DeleteBulkAction::make() ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}