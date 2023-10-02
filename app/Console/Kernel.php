<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // input otomatis
        $schedule->command('app:insert-input1')->dailyAt('02:00');
        $schedule->command('app:insert-input2')->dailyAt('02:00');
        $schedule->command('app:insert-input3')->dailyAt('02:00');

        // update status otomatis
        $schedule->command('app:update-status-input1')->everyMinute();
        $schedule->command('app:update-status-input2')->everyMinute();
        $schedule->command('app:update-status-input3')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
