<?php

namespace App\Jobs;

use App\Mail\VaccineSchedule;
use App\Models\User;
use App\Models\UserVaccineRegistration;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
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
        
         $users=UserVaccineRegistration::where('is_scheduled',0)
         
         ->get();
        //  dd($users);
          
         foreach($users as $user){
            Mail::to($user->email)->queue(new VaccineSchedule(user:$user));
            $user->is_scheduled=true;
            $user->save();
         }
    }
}
