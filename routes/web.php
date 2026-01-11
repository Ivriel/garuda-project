<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('flights', [FlightController::class, 'index'])->name('flight.index');
Route::get('flight/{flightNumber}/choose-tier', [FlightController::class, 'show'])->name('flight.show');
Route::get('flight/booking/{flightNumber}', [BookingController::class, 'booking'])->name('booking');

Route::get('flight/booking/{flightNumber}/choose-seat', [BookingController::class, 'chooseSeat'])->name('booking.chooseSeat');
Route::post('flight/booking/{flightNumber}/confirm-seat', [BookingController::class, 'confirmSeat'])->name('booking.confirmSeat');
Route::get('flight/booking/{flightNumber}/passenger-details', [BookingController::class, 'passengerDetails'])->name('booking.passengerDetails');
Route::post('flight/booking/{flightNumber}/save-passenger-details', [BookingController::class, 'savePassengerDetails'])->name('booking.savePassengerDetails');

Route::get('flight/booking/{flightNumber}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('flight/booking/{flightNumber}/payment', [BookingController::class, 'payment'])->name('booking.payment');

Route::get('/booking-success', [BookingController::class, 'success'])->name('booking.success');

Route::get('check-booking', [BookingController::class, 'checkBooking'])->name('booking.check');
