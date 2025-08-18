<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Filament\Resources\BusResource\RelationManagers;
use App\Models\Bus;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    // protected static ?string $navigationIcon = 'heroicon-s-truck';

    // Tambahkan baris ini
    protected static ?string $navigationGroup = "Bus";
    protected static ?string $navigationLabel = "Daftar Bus";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make("route_id")
                    ->relationship("route", "name")
                    ->required(),
                Forms\Components\TextInput::make("plate_number")
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make("capacity")
                    ->numeric()
                    ->required(),
                Forms\Components\TimePicker::make("departure_time")
                    ->required()
                    ->seconds(false)
                    ->default("06:00"),

                // Kolom Durasi Perjalanan
                Forms\Components\TextInput::make("duration_in_minutes")
                    ->label("Duration (minutes)")
                    ->numeric()
                    ->live()
                    ->required()
                    ->afterStateUpdated(function (
                        $state,
                        Forms\Get $get,
                        Forms\Set $set,
                    ) {
                        $departureTime = $get("departure_time");
                        $duration = (int) $state; // <-- Tambahkan (int) di sini

                        if ($departureTime && $duration) {
                            $arrival = Carbon::parse(
                                $departureTime,
                            )->addMinutes($duration);
                            $set("arrival_time", $arrival->toTimeString());
                        }
                    }),

                // Kolom Waktu Kedatangan
                Forms\Components\TimePicker::make("arrival_time")
                    ->live()
                    ->required()
                    ->seconds(false)
                    ->afterStateUpdated(function (
                        $state,
                        Forms\Get $get,
                        Forms\Set $set,
                    ) {
                        $departureTime = $get("departure_time");
                        $arrivalTime = $state;

                        if ($departureTime && $arrivalTime) {
                            $duration = Carbon::parse(
                                $departureTime,
                            )->diffInMinutes(Carbon::parse($arrivalTime));
                            $set("duration_in_minutes", $duration);
                        }
                    }),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("plate_number")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make("route.name")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make("capacity")->sortable() 
                    ->searchable(),
                Tables\Columns\TextColumn::make("departure_time")->sortable() 
                    ->dateTime("H:i"),
                Tables\Columns\TextColumn::make("arrival_time")->sortable()
                    ->dateTime("H:i"),
            ])
            ->filters([])
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
            Components\TextEntry::make("plate_number"),
            Components\TextEntry::make("route.name"),
            Components\TextEntry::make("capacity"),
            Components\TextEntry::make("duration_in_minutes"),
            Components\TextEntry::make("departure_time"),
            Components\TextEntry::make("arrival_time"),
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
            "index" => Pages\ListBuses::route("/"),
            "create" => Pages\CreateBus::route("/create"),
            "edit" => Pages\EditBus::route("/{record}/edit"),
            "view" => Pages\ViewBus::route("/{record}"),
        ];
    }
}
