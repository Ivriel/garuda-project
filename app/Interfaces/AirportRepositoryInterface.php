<?php

namespace App\Interfaces;

interface AirportRepository
{
    public function getAllAirports();

    public function getAirportBySlug($slug);

    public function getAirportByIataCode($iataCode);
}
