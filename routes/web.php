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
  $user=User::findOrFail(1);
$date=$user->created_at->format('Y-m-d');
   dump($date);
   dump(Carbon::parse($date)->format('l')==='Tuesday ');
});
 Route::get('register',UserRegistration::class);