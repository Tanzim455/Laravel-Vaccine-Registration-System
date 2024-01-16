<?php

namespace App\Livewire;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\VaccineCentre;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserRegistration extends Component
{
    
    
    public   $email;
    
    public   $name;
    public    $nid;
     public    $phone_number;
     public    $vaccine_centre_id;
    
    public function save()
    {
        $validated = $this->validate();

$user = User::create($validated);
//Daily Limit of users preferred vaccine centre
$perDayLimitOfUsersPreferredVaccineCentre = $user->vaccinecentre->daily_limit;

$scheduledDate = Carbon::parse($user->created_at)->addDay(1)->format('Y-m-d');


//Total schedule in Users preferred vaccine centre
$totalScheduledInThatDayOfPreferredVaccineCentre = User::where('vaccine_centre_id', $user->vaccineCentre->id)
    ->where('scheduled_date', $scheduledDate)
    ->count();
    // dd($totalScheduledInThatDayOfPreferredVaccineCentre);
    $scheduledDateIfItsSaturday = Carbon::parse($user->created_at)->addDay(2);
    
//Scheduled date if its Friday
$scheduledDateIfItsFriday = Carbon::parse($user->created_at)->addDay(3);
//Check if the day is Thursday or Friday
$specificDayOfScheduledDate = Carbon::parse($scheduledDate)->format('l');
// $itsThursday = $specificDayOfScheduledDate === 'Thursday';
$itsFriday = $specificDayOfScheduledDate === 'Friday'; 
$itsSaturday = $specificDayOfScheduledDate === 'Saturday'; 
if ($totalScheduledInThatDayOfPreferredVaccineCentre < $perDayLimitOfUsersPreferredVaccineCentre) {
    // Set the scheduled_date during user creation
    if ($itsFriday) {
        $scheduledDate = $scheduledDateIfItsFriday;
    } elseif ($itsSaturday) {
        $scheduledDate = $scheduledDateIfItsSaturday;
    }
    $user->update([
        'scheduled_date' => $scheduledDate,
    ]);
}else{
    // dd("It has exceeded the capacity");
    //Check if a date greater than the scheduled date exists
    // $date_greater_than_schedule_day_exists=User::where('vaccine_centre_id', $user->vaccine_centre_id)
    // ->where('scheduled_date','>',$scheduledDate)->exists();
  
    $scheduledDatesOfPreferredVaccineCentre = User::where('vaccine_centre_id', $user->vaccine_centre_id)
    ->pluck('scheduled_date')
    ->toArray();
    // dd($scheduledDatesOfPreferredVaccineCentre);
//    dd($scheduledDatesOfPreferredVaccineCentre);
// $count = User::where('scheduled_date', '2024-01-17')
// ->where('vaccine_centre_id', $user->vaccine_centre_id)
// ->count();
// dd($count);
    foreach ($scheduledDatesOfPreferredVaccineCentre as $scheduledDate) {
        
        $count = User::where('scheduled_date', '2024-01-17')->count();
            dd($count);
            break;
        if ($count !== $perDayLimitOfUsersPreferredVaccineCentre) {
            $newScheduledDate = Carbon::parse($scheduledDate)->addDays(1);
                
            if ($newScheduledDate->format("l") ==='Friday') {
                $newScheduledDate->addDays(2);
            } elseif ($newScheduledDate->format("l") ==='Saturday') {
                $newScheduledDate->addDays(1);
            }

            $user->update([
                'scheduled_date' => $newScheduledDate->format('Y-m-d')
            ]);

            break;
        }else{
            dd("Sorry it has exceeded the limit");
        }
        // dump($scheduledDate) ;
    }

   
}

// Reset the Livewire component state after creating the user
$this->reset();

        session()->flash('success', 'You have been successfully registered.Soon you will get an email with confirmation date');
        

    }
 
    protected function rules(): array
    {
        return (new RegisterRequest())->rules();
    }
    
    
        

    //     session()->flash('success', 'You have been successfully registered.Soon you will get an email with confirmation date');
    // }
    public function render()
    {
        $vaccineCentres=VaccineCentre::select('id','name','daily_limit')->get();
        return view('livewire.user-registration',compact('vaccineCentres'));
    }
    
}
