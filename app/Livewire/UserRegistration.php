<?php

namespace App\Livewire;

use App\Models\VaccineCentre;
use Livewire\Component;

class UserRegistration extends Component
{
    public string $title;
    public int $count=0;
    public function increment(){
       $this->count++;
    }
    public function render()
    {
        $vaccineCentres=VaccineCentre::select('id','name','daily_limit')->get();
        return view('livewire.user-registration',compact('vaccineCentres'));
    }
    
}
