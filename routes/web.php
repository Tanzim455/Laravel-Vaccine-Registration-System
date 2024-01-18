<?php

use App\Jobs\VaccineScheduleJob;
use App\Livewire\UserRegistration;
use App\Mail\VaccineSchedule;
use App\Models\User;
use App\Models\VaccineCentre;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // $day = Carbon::parse(Carbon::now()->format('Y-m-d'));
    //     //Find all schedule dates greater than current date
    //     $scheduled_dates = User::where('scheduled_date', '>', $day)->pluck('scheduled_date');
    //     // dd($scheduled_dates);
    //     //Find earliest date from them
    //      $min=$scheduled_dates->min();
         
    //     //  dd($min);
    //      //Find out all users who are scheduled earlist from today
    //      $users=User::where('is_scheduled',0)
    //      ->where('scheduled_date','=',$min)
    //      ->get();
    //      dd($users);
          
    //      foreach($users as $user){
    //         Mail::to($user->email)->queue(new VaccineSchedule(user:$user));
    //         $user->is_scheduled=true;
    //         $user->save();
    //      }
    VaccineScheduleJob::dispatch();
   
  });
 Route::get('register',UserRegistration::class);