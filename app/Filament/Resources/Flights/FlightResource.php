<?php

namespace App\Filament\Resources\Flights;

use App\Filament\Resources\Flights\Pages\CreateFlight;
use App\Filament\Resources\Flights\Pages\EditFlight;
use App\Filament\Resources\Flights\Pages\ListFlights;
use App\Filament\Resources\Flights\Pages\ViewFlight;
use App\Filament\Resources\Flights\Schemas\FlightForm;
use App\Filament\Resources\Flights\Schemas\FlightInfolist;
use App\Filament\Resources\Flights\Tables\FlightsTable;
use App\Models\Flight;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowUpRight;

    protected static ?string $recordTitleAttribute = 'number';

    public static function form(Schema $schema): Schema
    {
        return FlightForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FlightInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FlightsTable::configure($table);
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
            'index' => ListFlights::route('/'),
            'create' => CreateFlight::route('/create'),
            'view' => ViewFlight::route('/{record}'),
            'edit' => EditFlight::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
