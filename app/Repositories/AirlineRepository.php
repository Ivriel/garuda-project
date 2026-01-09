<?php

namespace App\Repositories;

use App\Interfaces\AirlineRepositoryInterface;
use App\Models\Airline;

class AirlineRepository implements AirlineRepositoryInterface
{
    public function getAllAirlines()
    {
        return Airline::all();
    }
}
