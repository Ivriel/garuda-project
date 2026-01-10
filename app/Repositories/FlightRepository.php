<?php

namespace App\Repositories;

use App\Interfaces\FlightRepositoryInterface;
use App\Models\Flight;

class FlightRepository implements FlightRepositoryInterface
{
    public function getAllFlights($filter = null)
    {
        $flights = Flight::query();

        if (! empty($filter['departure'])) {
            $flights->whereHas('segments', function ($query) use ($filter) {
                $query->where('airport_id', $filter['departure'])
                    ->where('sequence', 1);
            });
        }

        if (! empty($filter['arrival'])) {
            $flights->whereHas('segments', function ($query) use ($filter) {
                $query->where('airport_id', $filter['arrival'])
                    ->orderBy('sequence', 'desc')
                    ->limit(1);
            });
        }

        if (! empty($filter['date'])) {
            $flights->whereHas('segments', function ($query) use ($filter) {
                $query->whereDate('time', $filter['date']);
            });
        }

        return $flights->get();
    }

    public function getFlightByFlightNumber($flightNumber)
    {
        return Flight::with(['segments.airport', 'airline', 'seats', 'classes'])->where('flight_number', $flightNumber)->first();
    }
}
