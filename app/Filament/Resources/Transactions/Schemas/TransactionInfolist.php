<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Umum')
                    ->schema([
                        TextEntry::make('code')
                            ->label('Code'),
                        TextEntry::make('flight.flight_number')
                            ->label('Flight'),
                        TextEntry::make('class.class_type')
                            ->label('Class'),
                    ])
                    ->columnSpan(2),

                Section::make('Informasi Penumpang')
                    ->schema([
                        TextEntry::make('number_of_passengers')
                            ->label('Number of passengers')
                            ->numeric(),
                        TextEntry::make('name')
                            ->label('Name'),
                        TextEntry::make('email')
                            ->label('Email address'),
                        TextEntry::make('phone')
                            ->label('Phone'),

                        RepeatableEntry::make('passengers')
                            ->label('Daftar Penumpang')
                            ->schema([
                                TextEntry::make('seat.name')
                                    ->label('Seat Name')
                                    ->placeholder('No seat assigned'),
                                TextEntry::make('name')
                                    ->label('Name'),
                                TextEntry::make('date_of_birth')
                                    ->label('Date of birth')
                                    ->date(),
                                TextEntry::make('nationality')
                                    ->label('Nationality'),
                            ])
                            ->columns(2)
                            ->visible(fn ($record) => $record->passengers && $record->passengers->count() > 0),
                    ])
                    ->columnSpan(2),

                Section::make('Pembayaran')
                    ->schema([
                        TextEntry::make('promo.code')
                            ->label('Promo Code')
                            ->placeholder('No promo code used'),
                        TextEntry::make('promo.discount_type')
                            ->label('Discount Type')
                            ->placeholder('No discount'),
                        TextEntry::make('promo.discount')
                            ->label('Discount')
                            ->placeholder('No discount'),
                        TextEntry::make('payment_status')
                            ->label('Payment status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'paid' => 'success',
                                'failed' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->money('IDR'),
                        TextEntry::make('grandtotal')
                            ->label('Grandtotal')
                            ->numeric()
                            ->money('IDR'),
                    ])
                    ->columnSpan(2),

                Section::make('Informasi Sistem')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat pada')
                            ->dateTime()
                            ->timezone('Asia/Jakarta'), // Paksa ke WIB

                        TextEntry::make('updated_at')
                            ->label('Diperbarui pada')
                            ->dateTime()
                            ->timezone('Asia/Jakarta'),

                        TextEntry::make('deleted_at')
                            ->label('Dihapus pada')
                            ->dateTime()
                            ->timezone('Asia/Jakarta')
                            ->placeholder('Belum dihapus'),
                    ])
                    ->columnSpan('full')
                    ->collapsible(),
            ]);
    }
}
