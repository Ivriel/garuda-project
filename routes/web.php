<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('flights',[FlightController::class, 'index'])->name('flight.index');

Route::get('check-booking',[BookingController::class, 'checkBooking'])->name('booking.check');
