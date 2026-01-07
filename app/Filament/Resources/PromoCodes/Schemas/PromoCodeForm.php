<?php

namespace App\Filament\Resources\PromoCodes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PromoCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                Select::make('discount_type')
                    ->options(['fixed' => 'Fixed', 'percentage' => 'Percentage'])
                    ->required(),
                TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                DateTimePicker::make('valid_until')
                    ->required(),
                Toggle::make('is_used')
                    ->required(),
            ]);
    }
}
