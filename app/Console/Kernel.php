<?php

namespace App\Console;

use App\Listeners\SendCounterExpiredNotification;
use App\Models\Counter;
use App\Notifications\CounterExpired;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $dates = Counter::select('valid_until')->get();

        foreach ($dates as $date) {
            $dateC = Carbon::createFromFormat('Y-m-d', $date->valid_until);

            $schedule->job(
                SendCounterExpiredNotification::class
            )->cron(
                "0 4 {$dateC->day} {$dateC->month} *"
            );
        }

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
