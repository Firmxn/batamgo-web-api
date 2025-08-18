<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RouteResource\Pages;
use App\Filament\Resources\RouteResource\RelationManagers;
use App\Models\Route;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RouteResource extends Resource
{
    protected static ?string $model = Route::class;

    // protected static ?string $navigationIcon = 'heroicon-s-map';

    protected static ?string $navigationGroup = "Route";
    protected static ?string $navigationLabel = "Daftar Route";

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make("name")
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),
            Forms\Components\Textarea::make("description"),
            Forms\Components\Select::make("shelters")
                ->relationship("shelters", "name")
                ->multiple()
                ->preload()
                ->searchable()
                ->label("Shelters"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make("shelters.name")
                    ->searchable()
                    ->label("Shelters")
                    ->bulleted(), // <-- Tambahkan ini untuk menampilkan shelter dengan line breaks
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Components\TextEntry::make("name"),
            Components\TextEntry::make("description"),
            Components\TextEntry::make("shelters.name") // <-- Perubahan di sini
                ->label("Shelters")
                ->bulleted(), // <-- Tambahkan ini
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
            "index" => Pages\ListRoutes::route("/"),
            "create" => Pages\CreateRoute::route("/create"),
            "edit" => Pages\EditRoute::route("/{record}/edit"),
            "view" => Pages\ViewRoute::route("/{record}"),
        ];
    }
}
