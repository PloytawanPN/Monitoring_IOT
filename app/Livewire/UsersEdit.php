<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UsersEdit extends Component
{
    public $id,$user,$name,$email,$password,$branch_id,$status,$role;
    public $branch_list;
    public function mount($id){
        $this->id=$id;
        $this->user=DB::table('users')->where('id',$this->id)->first();
        if($this->user==null){
            Session::flash('alert:error');
            return redirect('/setting/users');
        }else{
            $this->name=$this->user->name;
            $this->email=$this->user->email;
            $this->password=$this->user->password;
            $this->branch_id=$this->user->branch_id;
            $this->status=$this->user->status;
            $this->role=$this->user->role;
            $this->branch_list=DB::table('branches')->where('status',1)->get();
        }
    }

    public function validate_data(){
        $this->validate([
            'name' => [
                'required',
                'regex:/\s+/',
                'regex:/^[A-Za-z\s]+$/',
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/[0-9]/',
                'regex:/[a-zA-Z]/',
            ],
            'branch_id' => 'required',
            'status' => 'required',
            'role' => 'required',
        ], [
            'fullname.regex' => 'Please check your full name.',
            'fullname.required' => 'The fullname field is required.',
            'branch_id.required' => 'The branch field is required.',
            'status.required' => 'The status field is required.',
            'role.required' => 'The role field is required.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must contain at least one letter and one number.',
        ]);
    }

    public function SaveUser(){
        try {
            $this->validate_data();

            $updateData = [
                'name' => $this->name,
                'branch_id' => $this->branch_id,
                'status' => $this->status,
                'role' => $this->role,
                'updated_at' => Carbon::now(),
            ];
            if ((!Hash::check($this->password, $this->user->password))&&($this->password!=$this->user->password)) {
                $updateData['password'] = Hash::make($this->password);
            }

            DB::table('users')
                ->where('id', $this->id)
                ->update($updateData);
            
            $this->dispatch('Success:Alert');
        } catch (Exception $e) {
            $this->dispatch('Error:Alert', ['message' => $e->getMessage()]);
        }
    }
    public function render()
    {
        return view('livewire.users-edit');
    }
}
