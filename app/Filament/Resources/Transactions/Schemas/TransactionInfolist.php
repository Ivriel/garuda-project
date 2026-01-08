<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('code'),
                TextEntry::make('flight.id')
                    ->numeric(),
                TextEntry::make('flight_class_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('phone'),
                TextEntry::make('number_of_passengers')
                    ->numeric(),
                TextEntry::make('promo_code_id')
                    ->numeric(),
                TextEntry::make('payment_status'),
                TextEntry::make('subtotal')
                    ->numeric(),
                TextEntry::make('grandtotal')
                    ->numeric(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
