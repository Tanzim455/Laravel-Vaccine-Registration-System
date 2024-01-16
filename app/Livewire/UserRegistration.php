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

$perDayLimitOfUsersPreferredVaccineCentre = $user->vaccinecentre->daily_limit;

$scheduledDate = Carbon::parse($user->created_at)->addDay(1)->format('Y-m-d');



$totalScheduledInThatDayOfPreferredVaccineCentre = User::where('vaccine_centre_id', $user->vaccineCentre->id)
    ->where('scheduled_date', $scheduledDate)
    ->count();

if ($totalScheduledInThatDayOfPreferredVaccineCentre < $perDayLimitOfUsersPreferredVaccineCentre) {
    // Set the scheduled_date during user creation
    $user->update([
        'scheduled_date' => $scheduledDate,
    ]);
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
