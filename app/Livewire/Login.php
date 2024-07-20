<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    public $username, $password;
    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = DB::table('users')
            ->where('email', $this->username)
            ->first();

        try {
            if ($user && Hash::check($this->password, $user->password)) {
                DB::table('users')->where('id', $user->id)->update(['remember_token' => Session::get('_token')]);
                $this->dispatch('Success:login');
            }else{
                $this->dispatch('Error:login');
            }
        } catch (\Throwable $th) {
            $this->dispatch('Error:login');
        }

    }
    public function render()
    {
        return view('livewire.login');
    }
}
