<?php

namespace App\Filament\Resources\Flights\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class FlightInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Flight Information')
                        ->components([
                            TextEntry::make('flight_number')
                                ->label('Flight Number'),
                            TextEntry::make('airline.name')
                                ->label('Airline'),
                        ]),
                    Step::make('Flight Segments')
                        ->components([
                            RepeatableEntry::make('segments')
                                ->label('Segments')
                                ->schema([
                                    TextEntry::make('sequence')
                                        ->label('Sequence'),
                                    TextEntry::make('airport.name')
                                        ->label('Airport'),
                                    TextEntry::make('time')
                                        ->label('Time')
                                        ->dateTime(),
                                ]),
                        ]),
                    Step::make('Flight Class')
                        ->components([
                            RepeatableEntry::make('classes')
                                ->label('Classes')
                                ->schema([
                                    TextEntry::make('class_type')
                                        ->label('Class Type'),
                                    TextEntry::make('price')
                                        ->label('Price')
                                        ->money('IDR'),
                                    TextEntry::make('total_seats')
                                        ->label('Total Seats'),
                                    TextEntry::make('facilities.name')
                                        ->label('Facilities')
                                        ->listWithLineBreaks(),
                                ]),
                        ]),
                ])->columnSpan(2),
            ]);
    }
}
