<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class Register extends Component
{
    public function submit(){

        Mail::to('poliplooy@gmail.com')->send(new SendMail());
        dd('Email ถูกส่งแล้ว');
    }
    public function render()
    {
        return view('livewire.register');
    }
}
 