<?php

namespace App\Filament\Resources\Airports\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AirportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('airports')
                    ->required()
                    ->columnSpan(2),
                TextInput::make('iata_code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('city')
                    ->required(),
                TextInput::make('country')
                    ->required(),
            ]);
    }
}
