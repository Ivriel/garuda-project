<?php

namespace App\Filament\Resources\Airports\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AirportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('iata_code'),
                TextEntry::make('name'),
                ImageEntry::make('image')
                    ->disk('public'),
                TextEntry::make('city'),
                TextEntry::make('country'),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
