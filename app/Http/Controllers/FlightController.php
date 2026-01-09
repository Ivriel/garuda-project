<?php

namespace App\Http\Controllers;

use App\Interfaces\AirlineRepositoryInterface;
use App\Interfaces\AirportRepositoryInterface;
use App\Interfaces\FlightRepositoryInterface;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    private AirportRepositoryInterface $airportRepository;
    private AirlineRepositoryInterface $airlineRepository;
    private FlightRepositoryInterface $flightRepository;

    public function __construct(
        AirportRepositoryInterface $airportRepository,
        AirlineRepositoryInterface $airlineRepository,
        FlightRepositoryInterface $flightRepository
        )
    {
        $this->airportRepository = $airportRepository;
        $this->airlineRepository = $airlineRepository;
        $this->flightRepository = $flightRepository;
    }
    public function index(Request $request)
    {
        $departure = $this->airportRepository->getAirportByIataCode($request->departure);
        $arrival = $this->airportRepository->getAirportByIataCode($request->arrival);
        $flights = $this->flightRepository->getAllFlights([
            'departure' => $departure->id ?? null,
            'arrival' => $arrival->id ?? null,
            'date' => $request->date ?? null
        ]);

        $airlines = $this->airlineRepository->getAllAirlines();
        return view('pages.flight.index',compact('flights','airlines'));
    }
}
