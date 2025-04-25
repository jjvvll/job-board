<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;


class NewJobPosted extends Component
{


    public function mount(){
       //
    }

    public function render()
    {
        return view('livewire.new-job-posted');
    }

    #[On('echo:channel-newJobPosted,NewJobPosted')]
    public function listenChangeStatus($event){
        dd('zhialovesme');
       $this->render();
    }
}
