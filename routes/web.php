<?php

use App\Livewire\UserRegistration;
use App\Models\User;
use Carbon\Carbon;
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
    User::findOrFail(1)->update([
      'scheduled_date'=>'2024-01-17'
    ]);
    dump(User::findOrFail(1));
  // $date=Carbon::parse($user->created_at)->addDay(1)->format('Y-m-d');
  //    dump($date);
  //    dump(Carbon::parse($date)->format('l')==='Tuesday ');
  });
 Route::get('register',UserRegistration::class);