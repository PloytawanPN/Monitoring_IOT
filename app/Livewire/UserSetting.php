<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UserSetting extends Component
{
    public $users_list,$fullname,$email,$password;

    public function remove($id){
        try {
            DB::table('users')->where('id',$id)->delete();
            $this->dispatch('remove_success');
        } catch (\Throwable $e) {
            $this->dispatch('error_alert');
        }
    }

    public function reject($id){
        try {
            DB::table('users')->where('id',$id)->update(['status' => 3]);
            $this->dispatch('reject_success');
        } catch (\Throwable $e) {
            $this->dispatch('error_alert');
        }
    }
    public function approve($id){
        try {
            DB::table('users')->where('id',$id)->update(['status' => 1]);
            $this->dispatch('approve_success');
        } catch (\Throwable $e) {
            $this->dispatch('error_alert');
        }
    }

    public function render()
    {
        $this->users_list=DB::table('users')->get();
        return view('livewire.user-setting');
    }
}
