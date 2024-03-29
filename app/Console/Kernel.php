<?php

namespace App\Console;

use App\Console\Commands\VaccineScheduleCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        VaccineScheduleCommand::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:vaccine-schedule')->dailyAt('21:00')
            ->days([0, 1, 2, 3, 4]); // 0 represents Sunday, 1 represents Monday, and so on
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
