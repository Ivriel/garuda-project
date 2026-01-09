<?php

namespace App\Interfaces;

interface AirportRepositoryInterface
{
    public function getAllAirports();

    public function getAirportBySlug($slug);

    public function getAirportByIataCode($iataCode);
}
