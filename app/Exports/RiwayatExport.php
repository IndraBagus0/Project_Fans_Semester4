<?php

namespace App\Exports;


use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RiwayatExport implements FromQuery, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Transaction::query()->with('Customer', 'User');
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->customer->name,
            $transaction->user->name,
            $transaction->date_transaction,
            $transaction->total,
            // Tambahkan kolom lain yang ingin Anda ekspor
        ];
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Pelanggan',
            'Admin',
            'Tanggal Transaksi',
            'Total'
            // Tambahkan judul kolom lain yang sesuai
        ];
    }
}
