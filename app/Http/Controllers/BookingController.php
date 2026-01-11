<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassengerDetailRequest;
use App\Interfaces\FlightRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use Exception;
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

        // Check if transaction data exists in session
        if (! $transaction || ! isset($transaction['flight_class_id'])) {
            return redirect()->route('flight.show', $flightNumber)
                ->with('error', 'Please start the booking process from the beginning.');
        }

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

        // Check if transaction data exists in session
        if (! $transaction || ! isset($transaction['flight_class_id']) || ! isset($transaction['selected_seats'])) {
            return redirect()->route('flight.show', $flightNumber)
                ->with('error', 'Please start the booking process from the beginning.');
        }

        $flight = $this->flightRepository->getFlightByFlightNumber($flightNumber);
        $tier = $flight->classes->find($transaction['flight_class_id']);

        return view('pages.booking.passenger-details', compact('transaction', 'flight', 'tier'));
    }

    public function savePassengerDetails(StorePassengerDetailRequest $request, $flightNumber)
    {
        $this->transactionRepository->saveTransactionDataToSession($request->all());

        return redirect()->route('booking.checkout', ['flightNumber' => $flightNumber]);
    }

    public function checkout($flightNumber)
    {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();

        // Check if transaction data exists in session
        if (! $transaction || ! isset($transaction['flight_class_id'])) {
            return redirect()->route('flight.show', $flightNumber)
                ->with('error', 'Please start the booking process from the beginning.');
        }

        $flight = $this->flightRepository->getFlightByFlightNumber($flightNumber);
        $tier = $flight->classes->find($transaction['flight_class_id']);

        return view('pages.booking.checkout', compact('transaction', 'flight', 'tier'));
    }

    public function payment(Request $request, $flightNumber)
    {
        $this->transactionRepository->saveTransactionDataToSession($request->all());
        $sessionData = $this->transactionRepository->getTransactionDataFromSession();

        // Check if required data exists
        if (! $sessionData || ! isset($sessionData['passengers']) || ! isset($sessionData['flight_class_id'])) {
            return back()->with('error', 'Missing required booking data. Please complete the booking process.');
        }

        $transaction = $this->transactionRepository->saveTransaction($sessionData);

        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction', false);
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized', true);
        \Midtrans\Config::$is3ds = config('midtrans.is3ds', true);

        // Prepare transaction parameters
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->code,
                'gross_amount' => (int) $transaction->grandtotal,
            ],
            'customer_details' => [
                'first_name' => $transaction->name,
                'email' => $transaction->email,
                'phone' => $transaction->phone,
            ],
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            return redirect($paymentUrl);
        } catch (Exception $e) {
            return back()->with('error', 'Payment gateway error: '.$e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $transaction = $this->transactionRepository->getTransactionByCode($request->order_id);

        if (! $transaction) {
            return redirect()->route('home');
        }

        return view('pages.booking.success', compact('transaction'));
    }

    public function checkBooking()
    {
        return view('pages.booking.check-booking');
    }
}
