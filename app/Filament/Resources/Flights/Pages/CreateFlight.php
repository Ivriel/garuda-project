<?php

namespace App\Filament\Resources\Flights\Pages;

use App\Filament\Resources\Flights\FlightResource;
use App\Models\Flight;
use Filament\Resources\Pages\CreateRecord;

class CreateFlight extends CreateRecord
{
    protected static string $resource = FlightResource::class;

    protected function afterCreate()
    {
        $flight = Flight::find($this->record->id); // mencari id yang di create dan melakukan generasi
        $flight->generateSeats();
    }
}
