<?php

namespace App\Livewire\Auth;

use Livewire\Component;


class Signout extends Component
{
    public function signout()
    {
        auth()->logout();
        return redirect()->route('signin');
    }
    public function render()
    {
        return view('livewire.auth.signout');
    }
}
