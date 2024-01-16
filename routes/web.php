<?php

use App\Livewire\UserRegistration;
use App\Models\User;
use App\Models\VaccineCentre;
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
    // $date_greater_than_scheduled_day_exists = User::where('vaccine_centre_id', 2)
    // ->where('scheduled_date', '>', '2024-01-17')
    // ->exists();

// if ($date_greater_than_scheduled_day_exists) {
//     dd("Loop Through on");
// } else {
//     dd("It does not exist.Just add one more day ");
// }

    // User::findOrFail(1)->update([
    //   'scheduled_date'=>'2024-01-17'
    // ]);
    // dump(User::findOrFail(1));
  // $date=Carbon::parse($user->created_at)->addDay(1)->format('Y-m-d');
  //    dump($date);
  //    dump(Carbon::parse($date)->format('l')==='Tuesday ');
//   $vaccine_centre_limit=VaccineCentre::findOrFail(2)->daily_limit;
//   dump($vaccine_centre_limit);
$user=User::select('vaccine_centre_id', 'scheduled_date')
->where('vaccine_centre_id', 2)
->groupBy('vaccine_centre_id', 'scheduled_date')
->selectRaw('COUNT(*) as count')
->get();
      foreach($user as $u){
        dump($u->count);
      }
  });
 Route::get('register',UserRegistration::class);