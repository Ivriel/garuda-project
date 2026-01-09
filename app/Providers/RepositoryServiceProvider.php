<?php

namespace App\Providers;

use App\Interfaces\AirlineRepositoryInterface;
use App\Interfaces\AirportRepositoryInterface;
use App\Interfaces\FlightRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Repositories\AirlineRepository;
use App\Repositories\AirportRepository;
use App\Repositories\FlightRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AirlineRepositoryInterface::class,AirlineRepository::class);
        $this->app->bind(AirportRepositoryInterface::class,AirportRepository::class);
        $this->app->bind(FlightRepositoryInterface::class,FlightRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class,TransactionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
