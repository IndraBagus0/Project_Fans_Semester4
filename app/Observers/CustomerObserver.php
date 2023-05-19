<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "updated" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updated(Customer $costumer)
    {
        if ($costumer->status === 'active') {
            // Cek apakah pelanggan sudah memiliki transaksi sebelumnya
            $existingTransaction = Transaction::where('id_costumer', $costumer->id)->first();

            if (!$existingTransaction) {
                $transaction = new Transaction();
                $transaction->date_transaction = now();
                $transaction->total = 1000; // Atur jumlah total sesuai kebutuhan

                // Menggunakan ID user dari session login
                $transaction->users = Auth::id();

                $transaction->id_costumer = $costumer->id;
                $transaction->save();
            }
        }
    }

    /**
     * Handle the Customer "deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function deleted(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "restored" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function restored(Customer $customer)
    {
        //
    }

    /**
     * Handle the Customer "force deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function forceDeleted(Customer $customer)
    {
        //
    }
}
