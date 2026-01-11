<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Builder;

class ViewTransaction extends ViewRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load the record with all necessary relationships
        $this->record->load([
            'flight',
            'class',
            'promo',
            'passengers.seat'
        ]);

        return $data;
    }

    public function mount(int | string $record): void
    {
        parent::mount($record);

        // Eager load relationships for infolist
        $this->record->load([
            'flight',
            'class',
            'promo',
            'passengers.seat'
        ]);
    }
}
