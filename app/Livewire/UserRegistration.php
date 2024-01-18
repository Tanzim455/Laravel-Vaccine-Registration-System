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
    $scheduledDateIfItsSaturday = Carbon::parse($scheduledDate)->addDay(1);
    
//Scheduled date if its Friday
$scheduledDateIfItsFriday = Carbon::parse($scheduledDate)->addDay(2);
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
    $countOfScheduledVaccineCentresbyDate=User::select('vaccine_centre_id', 'scheduled_date')
  ->where('vaccine_centre_id',$user->VaccineCentre->id)
  ->where('scheduled_date','>',Carbon::parse(Carbon::now())->format('Y-m-d'))
  ->groupBy('vaccine_centre_id', 'scheduled_date')
  ->selectRaw('COUNT(*) as count')
  ->get();

  foreach($countOfScheduledVaccineCentresbyDate as $count){
    $found=false;
     if($count->count !== $perDayLimitOfUsersPreferredVaccineCentre){
            $found=true;
            $collection = collect([]);
            $collection->push($count->scheduled_date);
            $earliest_date=$collection->min();
            //Update with this date
            $formatted_date=Carbon::parse($earliest_date)->format('Y-m-d');
            $user->update([
                'scheduled_date' =>$formatted_date,
            ]);

     }

     if(!$found){
        $newcollection=collect([]);
        $newcollection->push($count->scheduled_date);
        $latest_date=$newcollection->max();
        $scheduledDate = Carbon::parse($latest_date)->addDay(1)->format('Y-m-d');
        
         $specificDayOfScheduledDate = Carbon::parse($scheduledDate)->format('l');
       
    //     //Check whether the date is Friday or Saturday
         $itsFriday = $specificDayOfScheduledDate === 'Friday'; 
         $itsSaturday = $specificDayOfScheduledDate === 'Saturday'; 
    //     //Add One day and avoid Friday saturday
    //     //Scheduled date if its Friday
        $scheduledDateIfItsFriday = Carbon::parse($scheduledDate)->addDay(2)->format('Y-m-d');
        $scheduledDateIfItsSaturday = Carbon::parse($scheduledDate)->addDay(2)->format('Y-m-d');
       if(!$itsFriday || !$itsSaturday){
        $user->update([
            'scheduled_date' => $scheduledDate,
        ]);
       }

       if($itsFriday){
        $user->update([
            'scheduled_date' =>$scheduledDateIfItsFriday,
        ]);
       }
       if($itsSaturday){
        $user->update([
            'scheduled_date' =>$scheduledDateIfItsSaturday,
        ]);
       }
    
     }
  }
    }
    $this->reset();
    session()->flash('success', 'You have been successfully registered.Soon you will get an email with confirmation date');
}

// Reset the Livewire component state after creating the user

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
 
    
    

   