<?php

namespace App\Filament\Resources\Flights\Tables;

use App\Models\Flight;
use DateTime;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class FlightsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('flight_number')
                    ->searchable(),
                TextColumn::make('airline.name')
                    ->sortable(),
                TextColumn::make('route_duration')
                    ->label('Route & Duration')
                    ->getStateUsing(function (Flight $record): string {
                        $segments = $record->segments()->orderBy('sequence')->get();

                        if ($segments->isEmpty()) {
                            return '-';
                        }

                        $firstSegment = $segments->first();
                        $lastSegment = $segments->last();

                        if (! $firstSegment->airport || ! $lastSegment->airport) {
                            return '-';
                        }

                        $route = $firstSegment->airport->iata_code.' - '.$lastSegment->airport->iata_code;
                        $startTime = (new DateTime($firstSegment->time))->format('d F Y H:i');
                        $endTime = (new DateTime($lastSegment->time))->format('d F Y H:i');

                        return $route.' | '.$startTime.' - '.$endTime;
                    }),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
