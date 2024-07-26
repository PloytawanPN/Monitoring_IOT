<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function setting()
    {
        return view('template.setting.users_setting');
    }
    public function edit_user($id)
    {
        $decodedId = base64_decode($id);
        return view('template.setting.users_edit', ['id' => $decodedId]);
    }
}
