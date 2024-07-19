<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerifieldEmailController extends Controller
{
    public function index($token)
    {
        $user = DB::table('users')->where('remember_token', $token)->first();
        if ($user) {
            DB::table('users')
                ->where('remember_token', $token)
                ->update(['status' => 2,'email_verified_at' => Carbon::now(),'updated_at' => Carbon::now(),'remember_token'=>null]);
            return view('register.email_verifield_success');
        } else {
            return redirect('/signin');
        }

    }
}
