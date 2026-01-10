<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('flights',[FlightController::class, 'index'])->name('flight.index');
Route::get('flight/{flightNumber}/choose-tier',[FlightController::class, 'show'])->name('flight.show');
Route::get('flight/booking/{flightNumber}',[BookingController::class, 'booking'])->name('booking');
Route::get('flight/booking/{flightNumber}/choose-seat',[BookingController::class, 'chooseSeat'])->name('booking.chooseSeat');

Route::get('check-booking',[BookingController::class, 'checkBooking'])->name('booking.check');
