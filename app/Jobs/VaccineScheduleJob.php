<?php

namespace App\Jobs;

use App\Mail\VaccineSchedule;
use App\Models\User;
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
        //
        $day = Carbon::parse(Carbon::now()->format('Y-m-d'));
        //Find all schedule dates greater than current date
        $scheduled_dates = User::where('scheduled_date', '>', $day)->pluck('scheduled_date');
        // dd($scheduled_dates);
        //Find earliest date from them
         $min=$scheduled_dates->min();
         
        //  dd($min);
         //Find out all users who are scheduled earlist from today
         $users=User::where('is_scheduled',0)
         ->where('scheduled_date','=',$min)
         ->get();
        //  dd($users);
          
         foreach($users as $user){
            Mail::to($user->email)->queue(new VaccineSchedule(user:$user));
            $user->is_scheduled=true;
            $user->save();
         }
    }
}
