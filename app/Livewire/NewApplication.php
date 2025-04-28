<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Job;

class NewApplication extends Component
{

    public $job;

    public function mount(Job $job){
        $this->job =  $job;

    }
    public function render()
    {
        return view('livewire.new-application');
    }
}
