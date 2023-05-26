<?php

namespace App\Console;

use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // Dapatkan pelanggan dengan status 'active'
            $customers = Customer::where('status', 'active')->get();

            foreach ($customers as $customer) {
                $expireDate = Carbon::parse($customer->subcribe_date)->addDays(30);

                // Periksa apakah langganan telah berakhir
                if (Carbon::now()->gte($expireDate)) {
                    // Perbarui status menjadi 'non active'
                    $customer->status = 'non active';
                    $customer->save();

                    // Hapus jadwal
                    Schedule::where('customer_id', $customer->id)->delete();
                }
            }
        })->everySixHours(); // Menjalankan tugas setiap hari
    }



    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
