<?php

namespace App\Interfaces;

interface FlightRepositoryInterface
{
    public function getAllFlights($filter = null);

    public function getFlightByFlightNumber($flightNumber);
}
