<?php

namespace App\Console\Commands;

use App\Jobs\VaccineScheduleJob;
use Illuminate\Console\Command;

class VaccineSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:vaccine-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
         VaccineScheduleJob::dispatch();
        
    }
}
