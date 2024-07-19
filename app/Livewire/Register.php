<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Register extends Component
{
    public $fullname, $email, $branch, $password;

    public function validate_data(){
        $this->validate([
            'fullname' => [
                'required',
                'regex:/\s+/', 
                'regex:/^[A-Za-z\s]+$/', 
            ],
            'branch' => 'required',
            'email' => [
                'required',
                'email',
                'email', 
                function ($attribute, $value, $fail) {
                    $check_email = DB::table('users')->where('email', $this->email)->whereIn('status', [0,1,2])->count();
                    if ($check_email!=0) {
                        $fail("This email has already been used.");
                    }
                },
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/[0-9]/',     
                'regex:/[a-zA-Z]/', 
            ],
        ], [
            'fullname.regex' => 'Please check your full name.',
            'fullname.required' => 'The fullname field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email address is already taken.',
            'branch.required' => 'The branch field is required.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must contain at least one letter and one number.',
        ]);
    }

    public function submit()
    {
        try {
            $this->validate_data();
            DB::table('users')->insert([
                'name' => $this->fullname,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'remember_token' => 0,
                'branch' => $this->branch,
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            Mail::to($this->email)->send(new SendMail());
            $this->dispatch('Success:Alert');
        } catch (Exception $e) {
            $this->dispatch('Error:Alert', ['message' => $e->getMessage()]);
        }

    }
    public function render()
    {
        return view('livewire.register');
    }
}
