<?php

namespace App\Filament\Resources\Flights\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class FlightForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Flight Information')
                        ->components([
                            TextInput::make('flight_number')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true), // biar aman saat update di flight number yang sama
                            Select::make('airline_id')
                                ->relationship('airline', 'name') // isi dalam parameter name itu, sesuaikan persis dengan public function pendefine tipe relasinya
                                ->required(),
                        ]),
                    Step::make('Flight Segments')
                        ->components([
                            Repeater::make('flight_segments')
                                ->relationship('segments')
                                ->components([
                                    TextInput::make('sequence')
                                        ->numeric()
                                        ->required(),
                                    Select::make('airport_id')
                                        ->relationship('airport', 'name')
                                        ->required(),
                                    DateTimePicker::make('time')
                                        ->required(),
                                ])
                                ->collapsed(false)
                                ->minItems(1),
                        ]),
                    Step::make('Flight Class')
                        ->components([
                            Repeater::make('flight_classes')
                                ->relationship('classes')
                                ->components([
                                    Select::make('class_type')
                                        ->options([
                                            'business' => 'Business',
                                            'economy' => 'Economy',
                                        ])
                                        ->required(),
                                    TextInput::make('price')
                                        ->numeric()
                                        ->minValue(0)
                                        ->prefix('IDR')
                                        ->required(),
                                    TextInput::make('total_seats')
                                        ->numeric()
                                        ->minValue(1)
                                        ->label('Total Seats')
                                        ->required(),
                                    Select::make('facilities')
                                        ->relationship('facilities', 'name')
                                        ->multiple()
                                        ->required(),
                                ]),
                        ]),
                ])->columnSpan(2),
            ]);
    }
}
