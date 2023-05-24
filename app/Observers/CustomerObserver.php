<?php

namespace App\Observers;

use App\Models\Product;
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
    public function updated(Customer $customer)
    {
        if ($customer->status === 'active') {
            // Cek apakah pelanggan sudah memiliki transaksi sebelumnya
            $existingTransaction = Transaction::where('id_costumer', $customer->id)->first();

            if (!$existingTransaction) {
                $product = Product::where('id', $customer->id_product)->first(); // Mengambil produk dengan ID 1 (sesuaikan dengan kebutuhan Anda)
                if ($product) {
                    $transaction = new Transaction();
                    $transaction->date_transaction = now();
                    $transaction->total = $product->price; // Menggunakan harga produk sebagai total
                    // Menggunakan ID user dari session login
                    $transaction->users = Auth::id();
                    $transaction->id_costumer = $customer->id;
                    $transaction->save();
                }
            } else {
                $product = Product::where('id', $customer->id_product)->first(); // Mengambil produk dengan ID 1 (sesuaikan dengan kebutuhan Anda)
                if ($product) {
                    $transaction = new Transaction();
                    $transaction->date_transaction = now();
                    $transaction->total = $product->price; // Menggunakan harga produk sebagai total

                    // Menggunakan ID user dari session login
                    $transaction->users = Auth::id();

                    $transaction->id_costumer = $customer->id;
                    $transaction->save();
                }
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
