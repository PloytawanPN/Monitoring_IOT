<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Topbar extends Component
{
    public function logout(){
        Session::regenerate();
        return redirect('/signin');
    }
    public function render()
    {
        return view('livewire.topbar');
    }
}
