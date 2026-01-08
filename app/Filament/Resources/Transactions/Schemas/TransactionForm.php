<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Umum')
                    ->components([
                        TextInput::make('code'),
                        Select::make('flight_id')
                            ->relationship('flight', 'flight_number'),
                        Select::make('flight_class_id')
                            ->relationship('class', 'class_type')
                            ->distinct(),
                    ])
                    ->columnSpan(2),
                Section::make('Informasi Penumpang')
                    ->components([
                        TextInput::make('number_of_passenger'),
                        TextInput::make('name'),
                        TextInput::make('email'),
                        TextInput::make('phone'),
                        Section::make('Daftar Penumpang')
                            ->components([
                                Repeater::make('passenger')
                                    ->relationship('passengers')
                                    ->components([
                                        Select::make('flight_seat_id')
                                            ->relationship('seat', 'name'),
                                        TextInput::make('name'),
                                        TextInput::make('date_of_birth'),
                                        TextInput::make('nationality'),
                                    ]),
                            ]),
                    ])
                    ->columnSpan(2),
                Section::make('Pembayaran')
                    ->components([
                        TextInput::make('promo.code'),
                        TextInput::make('promo.discount_type'),
                        TextInput::make('promo.discount'),
                        TextInput::make('payment_status'),
                        TextInput::make('subtotal'),
                        TextInput::make('grandtotal'),
                    ])
                    ->columnSpan(2),
            ]);
    }
}
