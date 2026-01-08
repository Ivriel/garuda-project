<?php

namespace App\Interfaces;

interface FlightRepository
{
    public function getAllFlights($filter = null);

    public function getFlightByFlightNumber($flightNumber);
}
