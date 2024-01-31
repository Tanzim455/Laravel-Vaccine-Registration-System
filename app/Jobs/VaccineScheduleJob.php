<?php

namespace App\Jobs;

use App\Mail\VaccineSchedule;
use App\Models\UserVaccineRegistration;
use App\Models\VaccineCentre;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VaccineScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $vaccineCentres = VaccineCentre::withUnscheduledUsers()->get();
        foreach ($vaccineCentres as $vaccine) {
            if ($vaccine->users->count()) {

                $allIdsOfUsers = $vaccine->users->take($vaccine->daily_limit)->pluck('id')->toArray();
                $allusers = UserVaccineRegistration::whereIn('id', $allIdsOfUsers)->get();

                foreach ($allusers as $user) {
                    Mail::to($user->email)->queue(new VaccineSchedule(user: $user));
                    $user->is_scheduled = true;
                    $user->scheduled_date = Carbon::now('Asia/Dhaka')->addDay()->format('Y-m-d');
                    $user->save();
                }

            }

        }

    }
}
