<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

class Topbar extends Component
{
    public $user;
    public function logout(){
        Session::regenerate();
        return redirect('/signin');
    }
    public function mount(){
        $this->user=DB::table('users')->where('remember_token',Session::get('_token'))->first();
    }
    public function render()
    {
        
        return view('livewire.topbar');
    }
}
