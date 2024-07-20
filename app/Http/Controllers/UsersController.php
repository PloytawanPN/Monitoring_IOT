<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function setting()
    {
        return view('template.setting.users_setting');
    }
}
