<?php

namespace App\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $username,$password;
    public function login(){
        dd($this->username,$this->password);
    }
    public function render()
    {
        return view('livewire.login');
    }
}
