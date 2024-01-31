<?php

use App\Livewire\UserRegistration;
use App\Models\User;
use App\Models\UserVaccineRegistration;
use App\Models\VaccineCentre;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes aRoute::get('/vaccineCentrewithUsers',function(){re loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', UserRegistration::class);

