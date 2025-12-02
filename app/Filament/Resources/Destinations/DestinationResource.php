<?php

namespace App\Filament\Resources\Destinations;

use App\Filament\Resources\Destinations\Pages;
use App\Models\Destination;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

// --- ACTION PENTING (Edit & Delete) ---
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
// --------------------------------------

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
// Kita hapus import BulkActionGroup yang bikin error
use Illuminate\Support\Str;
use BackedEnum;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Destinasi')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\FileUpload::make('image_url')
                    ->label('Foto Destinasi')
                    ->image()
                    ->directory('destinations'),

                Forms\Components\TextInput::make('price')
                    ->label('Harga Tiket')
                    ->numeric()
                    ->prefix('Rp'),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('promoted')
                    ->label('Tampilkan di Slide Utama'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Foto'),
                
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                IconColumn::make('promoted')
                    ->boolean()
                    ->label('Promoted'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                // Kita matikan dulu fitur ini agar halaman tidak error
                // BulkActionGroup::make([
                //    DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}