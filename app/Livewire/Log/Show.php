<?php

namespace App\Livewire\Log;

use Livewire\Component;
use App\Models\Log;

class Show extends Component
{
    public $log;

    public function mount($slug) 
    {
        $this->log = Log::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.log.show');
    }
}