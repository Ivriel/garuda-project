<?php

namespace App\Http\Controllers;

use App\Interfaces\FlightRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private FlightRepositoryInterface $flightRepository;

    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(
        FlightRepositoryInterface $flightRepository,
        TransactionRepositoryInterface $transactionRepository
    ) {
        $this->flightRepository = $flightRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function booking(Request $request, $flightNumber)
    {
        $this->transactionRepository->saveTransactionDataToSession($request->all());

        return redirect()->route('booking.chooseSeat', ['flightNumber' => $flightNumber]);
    }

    public function chooseSeat(Request $request, $flightNumber)
    {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        $flight = $this->flightRepository->getFlightByFlightNumber($flightNumber);
        $tier = $flight->classes->find($transaction['flight_class_id']);

        return view('pages.booking.choose-seat', compact('transaction', 'flight', 'tier'));
    }

    public function confirmSeat(Request $request, $flightNumber)
    {
        $this->transactionRepository->saveTransactionDataToSession($request->all());

        return redirect()->route('booking.passengerDetails', ['flightNumber' => $flightNumber]);
    }

    public function passengerDetails(Request $request, $flightNumber)
    {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        $flight = $this->flightRepository->getFlightByFlightNumber($flightNumber);
        $tier = $flight->classes->find($transaction['flight_class_id']);

        return view('pages.booking.passenger-details', compact('transaction', 'flight', 'tier'));
    }

    public function checkBooking()
    {
        return view('pages.booking.check-booking');
    }
}
