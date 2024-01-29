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


 Route::get('/',UserRegistration::class);

 Route::get('testdate',function(){
      $current_date=Carbon::now()->format('Y-m-d');
      $registered_date='2024-01-30';
      dd($registered_date>$current_date);
 });