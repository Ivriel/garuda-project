<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\FlightClass;
use App\Models\PromoCode;
use App\Models\Transaction;
use App\Models\TransactionPassenger;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getTransactionDataFromSession()
    {
        return session()->get('transaction');
    }

    public function saveTransactionDataToSession($data)
    {
        $transaction = session()->get('transaction', []);

        foreach ($data as $key => $value) {
            $transaction[$key] = $value;
        }

        session()->put('transaction', $transaction);
    }

    public function saveTransaction($data)
    {
        $data['code'] = $this->generateTransactionCode();
        $data['number_of_passengers'] = $this->countPassengers($data['passengers']);

        $data['subtotal'] = $this->calculateSubtotal($data['flight_class_id'], $data['number_of_passengers']);
        $data['grandtotal'] = $data['subtotal'];
        // hitung subtotal dan grandtotal awal

        if (! empty($data['promo_code'])) {
            $data = $this->applyPromoCode($data);
        }

        // tambah PPN
        $data['grandtotal'] = $this->addPPN($data['grandtotal']);
        // simpan transaksi dan penumpang
        $transaction = $this->createTransaction($data);
        $this->savePassengers($data['passengers'], $transaction->id);

        session()->forget('transaction');

        return $transaction;
    }

    public function generateTransactionCode()
    {
        return 'BWAGARUDA'.rand(1000, 9999);
    }

    public function countPassengers($passengers)
    {
        return count($passengers);
    }

    public function calculateSubtotal($fligtClassId, $numberOfPassengers)
    {
        $price = FlightClass::findOrFail($fligtClassId)->price;

        return $price * $numberOfPassengers;
    }

    private function applyPromoCode($data)
    {
        $promo = PromoCode::where('code', $data['promo_code'])
            ->where('valid_until', '>=', now())
            ->where('is_used', false)
            ->first();

        if ($promo) {
            if ($promo->discount_type === 'percentage') {
                $data['discount'] = $data['grandtotal'] * ($promo->discount / 100);
            } else {
                $data['discount'] = $promo->discount;
            }

            $data['grandtotal'] -= $data['discount'];
            $data['promo_code_id'] = $promo->id;

            // tandai promo code yang sudah digunakan
            $promo->update(['is_used' => true]);
        }

        return $data;
    }

    private function addPPN($grandTotal)
    {
        $ppn = $grandTotal * 0.11;

        return $grandTotal + $ppn;
    }

    private function createTransaction($data)
    {
        return Transaction::create($data);
    }

    public function savePassengers($passengers, $transactionId)
    {
        foreach ($passengers as $passenger) {
            $passenger['transaction_id'] = $transactionId;
            TransactionPassenger::create($passenger);
        }
    }

    public function getTransactionByCode($code)
    {
        return Transaction::where('code', $code)->first();
    }

    public function getTransactionByCodePhone($code, $phone)
    {
        return Transaction::where('code', $code)->where('phone', $phone)->first();
    }
}
